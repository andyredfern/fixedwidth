<?php
/**
 * OutputRowParserTest PHPUnit Tests for OutputRowParser class
 *
 * Requires PHP version 7
 *
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
namespace Andyredfern\Fixedwidth;

/**
 * OutputRowParserTest PHPUnit Tests for OutputRowParser class
 *
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputRowParserTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Parses row aligned right.
     *
     * @return unused
     * @test
     */
    public function parseRowWithStringsAlignRight()
    {
        // Given
        $fieldSpecs = array(
                array(
                    "len" => "10",
                    "type" => "s",
                    "align" => "right"),
                array(
                    "len" => "15",
                    "type" => "s",
                    "align" => "right"),
            );
        $expectedValues = array("first", "second");
        $row = "     first         second";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, $expectedValues);
    }

    /**
     * Parses row aligned right by default.
     *
     * @return unused
     * @test
     */
    public function parseRowWithStringsAlignRightByDefault()
    {
        // Given
        $fieldSpecs = array(
                array(
                    "len" => "10",
                    "type" => "s"),
                array(
                    "len" => "15",
                    "type" => "s"),
            );
        $expectedValues = array("first", "second");
        $row = "     first         second";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, $expectedValues);
    }

    /**
     * Parses row aligned left.
     *
     * @return unused
     * @test
     */
    public function parseRowWithStringsAlignLeft()
    {
        // Given
        $fieldSpecs = array(
                array(
                    "len" => "10",
                    "type" => "s",
                    "align" => "left"),
                array(
                    "len" => "15",
                    "type" => "s",
                    "align" => "left"),
            );
        $expectedValues = array("first", "second");
        $row = "first     second         ";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, $expectedValues);
    }

    /**
     * Parses row with padding
     *
     * @return unused
     * @test
     */
    public function parseRowPadsWithGivenChar()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s"),
                array("len" => "15", "type" => "s"),
            );
        $expectedValues = array("first", "second");
        $row = "00000first000000000second";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, "0");

        // Then
        $this->assertEquals($result, $expectedValues);
    }

    /**
     * Parses row with mixed data
     *
     * @return unused
     * @test
     */
    public function parseRowWithMixedData()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s"),
                array("len" => "10", "type" => "i"),
                array("len" => "10", "type" => "f", "format" =>  "%09.4f"),
                array("len" => "10", "type" => "d", "format" => "Ymd"),
            );
        $expectedValues = array("first", 12, 3.45, date_parse("12 June 2021"));
        $row = "     first        12 0003.4500  20210612";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, $expectedValues);
    }

    /**
     * Throws if column out of fixed width row.
     *
     * @return unused
     * @test
     */
    public function parseRowShouldThrow()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s"),
                array("len" => "10", "type" => "s")
            );
        $row = "   ";
        $this->expectException(\OutOfBoundsException::class);

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");
    }

    /**
     * Parses row even if single field shorter than expected.
     *
     * @return unused
     * @test
     */
    public function parseRowShouldAttemptToParseEvenIfFieldShorter()
    {
        // Given
        $fieldSpecs = array(
                array(
                    "len" => "10",
                    "type" => "s",
                    "align" => "left"),
                array(
                    "len" => "15",
                    "type" => "s",
                    "align" => "left"),
            );
        $expectedValues = array("first", "second");
        $row = "first     second  ";

        // When
        $result = OutputRowParser::parse($row, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, $expectedValues);
    }
}
