<?php
/**
 * FieldFormatter class file
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
 * FieldFormatter Class for fomattimg a variable as fixed length padded string
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class FieldFormatter
{

    /**
     * Public function that process the $value and returns a
     * formatted, fixed-length string
     *
     * @param $value     can be a string, integer, floating point or date
     * @param array  $fieldSpec The parameters to control the output
     * @param string $padString string used to pad.
     *
     * @return string formatted string of the submitted $value
     */
    public static function format($value, $fieldSpec, $padString)
    {
        switch ($fieldSpec["type"]) {
        case "i": // integer
            $valueString = FieldFormatter::_formatInteger($value);
            break;
        case "f": // floating point
            $valueString = FieldFormatter::_formatFloat(
                $value,
                $fieldSpec["format"]
            );
            break;
        case "s": // string
            $valueString = $value;
            break;
        case "d": // date
            $valueString = FieldFormatter::_formatDate(
                $value,
                $fieldSpec["format"]
            );
            break;
        }
        return FieldFormatter::_normaliseString(
            $valueString,
            $fieldSpec["len"],
            $padString,
            $fieldSpec["align"] ?? "right"
        );
    }

    /**
     * Format integer as string.
     *
     * @param $value integer to be formatted.
     *
     * @return string formatted string.
     */
    private static function _formatInteger($value): string
    {
        if (empty($value)) {
            return "";
        }
        return strval($value);
    }

    /**
     * Format float as a string.
     *
     * @param $value  float to be formatted.
     * @param string $format format string. See sprintf().
     *
     * @return string formatted string.
     */
    private static function _formatFloat(
        $value,
        string $format = "%0.2f"
    ): string {
        if (empty($value)) {
            return "";
        }
        return sprintf($format, $value);
    }

    /**
     * Format date as string.
     *
     * @param $value  date to be formatted
     * @param string $format formatted string.
     *
     * @return string formatted string.
     */
    private static function _formatDate($value, string $format = "Ymd"): string
    {
        if (empty($value)) {
            return "";
        }
        return date($format, strtotime($value));
    }

    /**
     * Normalises string length by padding and trimming.
     *
     * @param string $value     string to be normalised.
     * @param int    $length    target length of string.
     * @param string $padString string to be used to pad.
     * @param string $align     alignment for of the string within padding.
     *
     * @return string string of normalised length.
     */
    private static function _normaliseString(
        string $value,
        int $length,
        string $padString,
        string $align = "right"
    ) {
        $padType = $align == "left" ? STR_PAD_RIGHT : STR_PAD_LEFT;
        $paddedValue = str_pad($value, $length, $padString, $padType);
        return substr($paddedValue, 0, $length);
    }
}
