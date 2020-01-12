<?php

namespace Andyredfern\Fixedwidth;

class OutputFileTest extends \PHPUnit\Framework\TestCase
{

    /** @test  */
    public function set_file_name_with_constructor() {

        $pathname="";
        $filename ="test.txt";
        $newFile= new OutputFile($pathname,$filename);

        $this->assertEquals($newFile->getFilename(),$filename);
        $this->assertEquals($newFile->getPathname(),$pathname);
    }
    
    /** @test  */
    public function set_file_name_and_pathname_with_constructor() {

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";
        $newFile= new OutputFile($pathname,$filename);

        $this->assertEquals($newFile->getFilename(),$filename);
        $this->assertEquals($newFile->getPathname(),$pathname);
    }

    /** @test  */
    public function set_file_name_with_setter() {

        $pathname="";
        $filename ="";
        $newFile= new OutputFile($pathname,$filename);

        $filename ="test.txt";

        $newFile->setFilename($filename);

        $this->assertEquals($newFile->getFilename(),$filename);
        $this->assertEquals($newFile->getPathname(),$pathname);
    }
    /** @test  */
    public function set_file_name_and_pathname_with_setter() {

        $pathname="";
        $filename ="";
        $newFile= new OutputFile($pathname,$filename);

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";

        $newFile->setFilename($filename);
        $newFile->setPathname($pathname);

        $this->assertEquals($newFile->getFilename(),$filename);
        $this->assertEquals($newFile->getPathname(),$pathname);
    }

    /** @test  */
    public function use_get_fullpath_with_constructor() {

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";
        $fullPath = $pathname . $filename;
        $newFile= new OutputFile($pathname,$filename);

        $this->assertEquals($newFile->getFullpath(),$fullPath);
    }

    //** @test */
    public function check_default_padding_char_string() {
        $newFile= new OutputFile();

        $this->assertEquals($newFile->getPaddingCharString()," ");

        $newFile->setPaddingChar("0");
        $this->assertEquals($newFile->getPaddingCharString(),"0");
    }

    
    //** @test */
    public function check_default_padding_char_integer() {
        $newFile= new OutputFile();

        $this->assertEquals($newFile->getPaddingCharInteger(),"0");

        $newFile->setPaddingChar(" ");
        $this->assertEquals($newFile->getPaddingCharInteger()," ");
    }


}