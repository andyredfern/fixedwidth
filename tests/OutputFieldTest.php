<?php

namespace Andyredfern\Fixedwidth;

class OutputFieldTest extends \PHPUnit\Framework\TestCase
{

    /** @test  */
    public function output_various_integers() {

        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"10","type"=>"i","align"=>"right","name"=>"field1");
        $integer = 26;
    
        $result = $newField->outputField($fieldType,$integer);

        $this->assertEquals($result,"0000000026");

        $fieldType = array("len"=>"8","type"=>"i","align"=>"right","name"=>"field1");
        $integer = 3124;
    
        $result = $newField->outputField($fieldType,$integer);

        $this->assertEquals($result,"00003124");

        $newFile->setPaddingCharInteger(" ");

        $fieldType = array("len"=>"8","type"=>"i","align"=>"right","name"=>"field1");
        $integer = 199;
    
        $result = $newField->outputField($fieldType,$integer);

        $this->assertEquals($result,"     199");

    }

    /** @test  */
    public function output_various_dates() {

        $newFile = new OutputFile();

        $newField= new OutputField($newFile);

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Ymd");
        $date = "12 June 2021";
    
        $result = $newField->outputField($fieldType,$date);

        $this->assertEquals($result,"20210612");

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Ymd");
        $date = "";
    
        $result = $newField->outputField($fieldType,$date);

        $this->assertEquals($result,str_pad($newFile->getPaddingCharString(),8));

        $fieldType = array("len"=>"8","type"=>"d","align"=>"right","name"=>"field1","format"=>"Y-m-d");
        $date = "12 May 2022";
    
        $result = $newField->outputField($fieldType,$date);

        $this->assertEquals($result,"2022-05-12");

    }


}