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

    }
    
}