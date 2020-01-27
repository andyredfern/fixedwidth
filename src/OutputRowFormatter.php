<?php
/**
 * OutputRowFormatter class file
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
 * OutputRowFormatter Class for fomattimg a variable as fixed length padded string
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputRowFormatter
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
    public static function format(
        array $values,
        array $fieldSpecs,
        string $padString
    ): string {
        if (count($values) != count($fieldSpecs)) {
            throw new \InvalidArgumentException(
                "Expecting number of values to equal number of field specs."
            );
        }

        $rowString = "";
        for ($x = 0; $x < count($values); $x++) {
            $rowString .= OutputFieldFormatter::format(
                $values[$x],
                $fieldSpecs[$x],
                $padString
            );
        }
        return $rowString;
    }
}
