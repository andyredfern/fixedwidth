<?php
/**
 * FieldTest PHPUnit Tests for Field class
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
 * FieldTest PHPUnit Tests for Field class
 *
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class FieldFormatterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test integers are returned as correctly formatted string
     *
     * @return unused
     * @test
     */
    public function formatVariousIntegers()
    {

        $fieldType = array(
            "len" => "10",
            "type" => "i",
            "align" => "right",
            "name" => "field1");
        $integer = 26;

        $result = FieldFormatter::format($integer, $fieldType, "0");

        $this->assertEquals($result, "0000000026");

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right",
            "name" => "field1");
        $integer = 3124;

        $result = FieldFormatter::format($integer, $fieldType, "0");

        $this->assertEquals($result, "00003124");

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right",
            "name" => "field1");
        $integer = 199;

        $result = FieldFormatter::format($integer, $fieldType, " ");

        $this->assertEquals($result, "     199");

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right",
            "name" => "field1");
        $integer = 0;

        $result = FieldFormatter::format($integer, $fieldType, " ");

        $this->assertEquals($result, "       0");

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right",
            "name" => "field1");
        $integer = "";

        $result = FieldFormatter::format($integer, $fieldType, " ");

        $this->assertEquals($result, "        ");

    }

    /**
     * Test floats are returned as correctly formatted string
     *
     * @return unused
     * @test
     */
    public function formatVariousFloats()
    {
        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "name" => "field1",
            "format" => "%09.4f");
        $float = 12.34;

        $result = FieldFormatter::format($float, $fieldType, " ");

        $this->assertEquals($result, "0012.3400");

        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "name" => "field1",
            "format" => "%0.2f");
        $float = 12.3456;

        $result = FieldFormatter::format($float, $fieldType, " ");

        $this->assertEquals($result, "    12.35");

        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "name" => "field1",
            "format" => "%0.2f");
        $float = 0.0;

        $result = FieldFormatter::format($float, $fieldType, " ");

        $this->assertEquals($result, "     0.00");

        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "name" => "field1",
            "format" => "%0.2f");
        $float = 0;

        $result = FieldFormatter::format($float, $fieldType, " ");

        $this->assertEquals($result, "     0.00");

        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "name" => "field1",
            "format" => "%0.2f");
        $float = "";

        $result = FieldFormatter::format($float, $fieldType, " ");

        $this->assertEquals($result, "         ");
    }

    /**
     * Test dates are returned as correctly formatted string
     *
     * @return unused
     * @test
     */
    public function formatVariousDates()
    {

        $fieldType = array(
            "len" => "8",
            "type" => "d",
            "align" => "right",
            "name" => "field1",
            "format" => "Ymd");
        $date = "12 June 2021";

        $result = FieldFormatter::format($date, $fieldType, " ");

        $this->assertEquals($result, "20210612");

        $fieldType = array(
            "len" => "8",
            "type" => "d",
            "align" => "right",
            "name" => "field1",
            "format" => "Ymd");
        $date = "";

        $result = FieldFormatter::format($date, $fieldType, " ");

        $this->assertEquals($result, str_pad(" ", 8));

        $fieldType = array(
            "len" => "10",
            "type" => "d",
            "align" => "right",
            "name" => "field1",
            "format" => "Y-m-d");
        $date = "12 May 2022";

        $result = FieldFormatter::format($date, $fieldType, " ");

        $this->assertEquals($result, "2022-05-12");

    }

    /**
     * Test strings are returned as correctly formatted string
     *
     * @return unused
     * @test
     */
    public function formatVariousStrings()
    {

        $fieldType = array(
            "len" => "8",
            "type" => "s",
            "align" => "left",
            "name" => "field1");
        $str = "Hello";

        $result = FieldFormatter::format($str, $fieldType, " ");

        $this->assertEquals($result, "Hello   ");

        $fieldType = array(
            "len" => "10",
            "type" => "s",
            "align" => "right",
            "name" => "field1");
        $str = "HelloHello";

        $result = FieldFormatter::format($str, $fieldType, " ");

        $this->assertEquals($result, "HelloHello");

        $fieldType = array(
            "len" => "5",
            "type" => "s",
            "align" => "right",
            "name" => "field1");
        $str = "HelloHello";

        $result = FieldFormatter::format($str, $fieldType, " ");

        $this->assertEquals($result, "Hello");

    }
}
