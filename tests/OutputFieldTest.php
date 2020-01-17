<?php
/**
 * OutputFieldTest PHPUnit Tests for OutputField class
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
class OutputFieldTest extends \PHPUnit\Framework\TestCase
{

    /** 
     * Test integers are returned as correctly formatted string
     * 
     * @return unused
     * @test 
     */
    public function outputVariousIntegers()
    {
        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"10",
                           "type"=>"i",
                           "align"=>"right",
                           "name"=>"field1");
        $integer = 26;
    
        $result = $newField->outputField($fieldType, $integer);

        $this->assertEquals($result, "0000000026");

        $fieldType = array("len"=>"8",
                           "type"=>"i",
                           "align"=>"right",
                           "name"=>"field1");
        $integer = 3124;
    
        $result = $newField->outputField($fieldType, $integer);

        $this->assertEquals($result, "00003124");

        $newFile->setPaddingCharInteger(" ");

        $fieldType = array("len"=>"8",
                           "type"=>"i",
                           "align"=>"right",
                           "name"=>"field1");
        $integer = 199;
    
        $result = $newField->outputField($fieldType, $integer);

        $this->assertEquals($result, "     199");

    }

    /** 
     * Test floats are returned as correctly formatted string
     * 
     * @return unused
     * @test  
     */
    public function outputVariousFloats()
    {
        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"10","type"=>"f","align"=>"right","name"=>"field1");
        $float = 12.34;
    
        $result = $newField->outputField($fieldType, $float);

        $this->assertEquals($result, "0000012.34");

        $fieldType = array("len"=>"20","type"=>"f","align"=>"right","name"=>"field1");
        $float = 123456.78;
    
        $result = $newField->outputField($fieldType, $float);

        $this->assertEquals($result, "00000000000123456.78");

        $fieldType = array("len"=>"20","type"=>"f","align"=>"right","name"=>"field1");
        $float = 3.14^10;
    
        $result = $newField->outputField($fieldType, $float);

        $this->assertEquals($result, "314000000000000000");
    }


    /** 
     * Test dates are returned as correctly formatted string
     * 
     * @return unused
     * @test  
     */
    public function outputVariousDates()
    {
        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Ymd");
        $date = "12 June 2021";
    
        $result = $newField->outputField($fieldType, $date);

        $this->assertEquals($result, "20210612");

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Ymd");
        $date = "";
    
        $result = $newField->outputField($fieldType, $date);

        $this->assertEquals($result, str_pad($newFile->getPaddingCharString(), 8));

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Y-m-d");
        $date = "12 May 2022";
    
        $result = $newField->outputField($fieldType, $date);

        $this->assertEquals($result, "2022-05-12");

    }

    /** 
     * Test strings are returned as correctly formatted string
     * 
     * @return unused
     * @test  
     */
    public function outputVariousStrings()
    {
        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"8","type"=>"s","align"=>"left","name"=>"field1");
        $date = "Hello";
    
        $result = $newField->outputField($fieldType, $date);

        $this->assertEquals($result, "Hello   ");

        $fieldType = array("len"=>"10","type"=>"s","align"=>"right","name"=>"field1");
        $date = "HelloHello";
    
        $result = $newField->outputField($fieldType, $date);

        $this->assertEquals($result, "HelloHello");

    }

}
