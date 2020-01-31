<?php
/**
 * FieldParser class file
 *
 * Requires PHP version 7
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
namespace Andyredfern\Fixedwidth;

/**
 * FieldParser Class for parsing a variable from a fixed length padded string.
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class FieldParser
{

    /**
     * Public function that parses a value from a fixed length padded string.
     *
     * @param string $string    string to be parsed.
     * @param array  $fieldSpec The parameters to control the parsing.
     * @param string $padString string used to pad.
     *
     * @return mixed parsed value
     */
    public static function parse(string $string, $fieldSpec, $padString)
    {
        $denormalisedString = FieldParser::_denormaliseString(
            $string,
            $padString,
            empty($fieldSpec["align"]) ? "right" : $fieldSpec["align"]
        );
        switch ($fieldSpec["type"]) {
        case "i": // integer
            $value = FieldParser::_parseInteger($denormalisedString);
            break;
        case "f": // floating point
            $value = FieldParser::_parseFloat($denormalisedString);
            break;
        case "s": // string
            $value = $denormalisedString;
            break;
        case "d": // date
            $value = FieldParser::_parseDate(
                $denormalisedString,
                empty($fieldSpec["format"]) ? "" : $fieldSpec["format"]
            );
            break;
        }
        return $value;
    }

    /**
     * Parse integer from string.
     *
     * @param $string string to be parsed.
     *
     * @return int parsed integer.
     */
    private static function _parseInteger(string $string): int
    {
        return intval($string);
    }

    /**
     * Parse float from string.
     *
     * @param $string string to be parsed.
     *
     * @return float parsed float.
     */
    private static function _parseFloat(string $string): float
    {
        return floatval($string);
    }

    /**
     * Parse date from string.
     *
     * @param $string string to be parsed.
     * @param string $format format string.
     *
     * @return array parsed date.
     */
    private static function _parseDate(string $string, string $format): array
    {
        if (empty($format)) {
            return date_parse($string);
        } else {
            return date_parse_from_format($format, $string);
        }
    }

    /**
     * Denormalises string by removing padding.
     *
     * @param string $string    string to be denormalised.
     * @param string $padString string to used to pad.
     * @param string $align     alignment for of the string within padding.
     *
     * @return string denormalised string.
     */
    private static function _denormaliseString(
        string $string,
        string $padString,
        string $align = "right"
    ): string {
        if ($align == "right") {
            $dePadded = ltrim($string, $padString);
        } else {
            $dePadded = rtrim($string, $padString);
        }
        return $dePadded;
    }
}
