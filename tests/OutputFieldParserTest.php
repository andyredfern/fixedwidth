<?php
/**
 * OutputFieldParserTest PHPUnit Tests for OutputFieldParser class
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
 * OutputFieldTest PHPUnit Tests for OutputField class
 *
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputFieldParserTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test integers are correctly parsed.
     *
     * @return unused
     * @test
     */
    public function parseVariousIntegers()
    {

        $fieldType = array(
            "len" => "10",
            "type" => "i",
            "align" => "right");
        $integerString = "0000000026";

        $result = OutputFieldParser::parse($integerString, $fieldType, "0");

        $this->assertEquals($result, 26);

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right");
        $integerString = "00003124";

        $result = OutputFieldParser::parse($integerString, $fieldType, "0");

        $this->assertEquals($result, 3124);

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "right");
        $integerString = "     199";

        $result = OutputFieldParser::parse($integerString, $fieldType, " ");

        $this->assertEquals($result, 199);

        $fieldType = array(
            "len" => "8",
            "type" => "i",
            "align" => "left");
        $integerString = "199     ";

        $result = OutputFieldParser::parse($integerString, $fieldType, " ");

        $this->assertEquals($result, 199);

    }

    /**
     * Test floats are correctly parsed.
     *
     * @return unused
     * @test
     */
    public function parseVariousFloats()
    {
        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "format" => "%09.4f");
        $float = "0012.3400";

        $result = OutputFieldParser::parse($float, $fieldType, " ");

        $this->assertEquals($result, 12.34);

        $fieldType = array(
            "len" => "9",
            "type" => "f",
            "align" => "right",
            "format" => "%0.2f");
        $float = "    12.35";

        $result = OutputFieldParser::parse($float, $fieldType, " ");

        $this->assertEquals($result, 12.35);
    }

    /**
     * Test dates are correctly parsed.
     *
     * @return unused
     * @test
     */
    public function parseVariousDates()
    {

        $fieldType = array(
            "len" => "8",
            "type" => "d",
            "align" => "right",
            "format" => "Ymd");
        $date = "20210612";

        $result = OutputFieldParser::parse($date, $fieldType, " ");
        $this->assertEquals($result["year"], 2021);
        $this->assertEquals($result["month"], 6);
        $this->assertEquals($result["day"], 12);

        $fieldType = array(
            "len" => "8",
            "type" => "d",
            "align" => "right",
            "format" => "Ymd");
        $date = str_pad(" ", 8);

        $result = OutputFieldParser::parse($date, $fieldType, " ");

        $this->assertTrue(array_key_exists("errors", $result));

        $fieldType = array(
            "len" => "10",
            "type" => "d",
            "align" => "right",
            "format" => "Y-m-d");
        $date = "2022-05-12";

        $result = OutputFieldParser::parse($date, $fieldType, " ");

        $this->assertEquals($result["year"], 2022);
        $this->assertEquals($result["month"], 5);
        $this->assertEquals($result["day"], 12);

        $fieldType = array(
            "len" => "10",
            "type" => "d",
            "align" => "right");
        $date = "2022-05-12";

        $result = OutputFieldParser::parse($date, $fieldType, " ");

        $this->assertEquals($result["year"], 2022);
        $this->assertEquals($result["month"], 5);
        $this->assertEquals($result["day"], 12);

        $fieldType = array(
            "len" => "15",
            "type" => "d",
            "align" => "right");
        $date = "      2022-05-12";

        $result = OutputFieldParser::parse($date, $fieldType, " ");

        $this->assertEquals($result["year"], 2022);
        $this->assertEquals($result["month"], 5);
        $this->assertEquals($result["day"], 12);

    }

    /**
     * Test strings are correctly parsed.
     *
     * @return unused
     * @test
     */
    public function parseVariousStrings()
    {

        $fieldType = array(
            "len" => "8",
            "type" => "s",
            "align" => "left");
        $str = "Hello   ";

        $result = OutputFieldParser::parse($str, $fieldType, " ");

        $this->assertEquals($result, "Hello");

        $fieldType = array(
            "len" => "10",
            "type" => "s",
            "align" => "right");
        $str = "HelloHello";

        $result = OutputFieldParser::parse($str, $fieldType, " ");

        $this->assertEquals($result, "HelloHello");
    }
}
