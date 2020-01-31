<?php
/**
 * RowFormatter class file
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
 * RowFormatter Class for fomattimg a variable as fixed length padded string
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class RowFormatter
{

    /**
     * Processes values according to fieldSpecs generating fixed width row.
     *
     * @param array  $values     can be a string, integer, floating point or date
     * @param array  $fieldSpecs The parameters to control the output
     * @param string $padString  string used to pad.
     *
     * @return string formatted string of the submitted $values
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
            $rowString .= FieldFormatter::format(
                $values[$x],
                $fieldSpecs[$x],
                $padString
            );
        }
        return $rowString;
    }
}
