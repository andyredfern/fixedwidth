<?php
/**
 * OutputRowFormatterTest PHPUnit Tests for OutputRowFormatter class
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
 * OutputRowFormatterTest PHPUnit Tests for OutputRowFormatter class
 *
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputRowFormatterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Formats strings and aligns right.
     *
     * @return unused
     * @test
     */
    public function formatRowWithStringsAlignRight()
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
        $values = array("first", "second");

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, "     first         second");
    }

    /**
     * Formats strings and aligns right by default.
     *
     * @return unused
     * @test
     */
    public function formatRowWithStringsAlignRightByDefault()
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
        $values = array("first", "second");

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, "     first         second");
    }

    /**
     * Formats strings and aligns left.
     *
     * @return unused
     * @test
     */
    public function formatRowWithStringsAlignLeft()
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
        $values = array("first", "second");

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, "first     second         ");
    }

    /**
     * Formats strings and pads with given char
     *
     * @return unused
     * @test
     */
    public function formatRowWPadsWithGivenChar()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s"),
                array("len" => "15", "type" => "s"),
            );
        $values = array("first", "second");

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, "0");

        // Then
        $this->assertEquals($result, "00000first000000000second");
    }

    /**
     * Formats mixed data
     *
     * @return unused
     * @test
     */
    public function formatRowWithMixedData()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s"),
                array("len" => "10", "type" => "i"),
                array("len" => "10", "type" => "f", "format" =>  "%09.4f"),
                array("len" => "10", "type" => "d", "format" => "Ymd"),
            );
        $values = array("first", 12, 3.45, "12 June 2021");

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, " ");

        // Then
        $this->assertEquals($result, "     first        12 0003.4500  20210612");
    }

    /**
     * Throws if number of specs different to values.
     *
     * @return unused
     * @test
     */
    public function formatRowShouldThrow()
    {
        // Given
        $fieldSpecs = array(
                array("len" => "10", "type" => "s")
            );
        $values = array("first", 12);
        $this->expectException(\InvalidArgumentException::class);

        // When
        $result = OutputRowFormatter::format($values, $fieldSpecs, " ");
    }
}
