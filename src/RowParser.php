<?php
/**
 * RowParser class file
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
 * RowParser Class for fomattimg a variable as fixed length padded string
 *
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class RowParser
{

    /**
     * Parses fixed width row according to fieldSpecs.
     *
     * @param array  $row        Fixed width string row.
     * @param array  $fieldSpecs The parameters to parse the row.
     * @param string $padString  string used to pad.
     *
     * @return array mixed parsed values.
     */
    public static function parse(
        string $row,
        array $fieldSpecs,
        string $padString
    ): array {
        $values = array();
        $position = 0;
        $rowWidth = strlen($row);

        foreach ($fieldSpecs as $spec) {

            $length = $spec["len"];

            if ($position > $rowWidth) {
                throw new \OutOfBoundsException(
                    "Specification expects column outside of given ".
                    "row width <$rowWidth>."
                );
            }

            $string = substr($row, $position, $length);

            $fieldWidth = $rowWidth - $position;
            if ($length > $fieldWidth) {
                echo "\nWarning: Expected field to be of width <$length>".
                " but actually <$fieldWidth>. ".
                "Attempting to parse data <$string> anyway.";
            }

            $values[] = FieldParser::parse($string, $spec, $padString);
            $position += $length;
        }

        return $values;
    }
}
