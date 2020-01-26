<?php
/**
 * OutputFileTest PHPUnit Tests for OutputFile
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
 * OutputFileTest PHPUnit Tests for OutputFile
 * 
 * @category Tests
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputFileTest extends \PHPUnit\Framework\TestCase
{

    /** 
     * Set Filename with the constructor
     * 
     * @return unused
     * @test  
     */
    public function setFilenameWithConstructor()
    {

        $pathname="";
        $filename ="test.txt";
        $newFile= new OutputFile($pathname, $filename);

        $this->assertEquals($newFile->getFilename(), $filename);
        $this->assertEquals($newFile->getPathname(), $pathname);
    }
    
    /** 
     * Set Filename and Pathname with the constructor
     * 
     * @return unused
     * @test  
     */
    public function setFilenameAndPathnameWithConstructor()
    {

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";
        $newFile= new OutputFile($pathname, $filename);

        $this->assertEquals($newFile->getFilename(), $filename);
        $this->assertEquals($newFile->getPathname(), $pathname);
    }

    /** 
     * Set Filename with the set method
     * 
     * @return unused
     * @test  
     */
    public function setFileNameWithSetter()
    {

        $pathname="";
        $filename ="";
        $newFile= new OutputFile($pathname, $filename);

        $filename ="test.txt";

        $newFile->setFilename($filename);

        $this->assertEquals($newFile->getFilename(), $filename);
        $this->assertEquals($newFile->getPathname(), $pathname);
    }

    /** 
     * Set Filename and Pathname with the set method
     * 
     * @return unused
     * @test  
     */
    public function setFilenameAndPathnameWithSetter()
    {

        $pathname="";
        $filename ="";
        $newFile= new OutputFile($pathname, $filename);

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";

        $newFile->setFilename($filename);
        $newFile->setPathname($pathname);

        $this->assertEquals($newFile->getFilename(), $filename);
        $this->assertEquals($newFile->getPathname(), $pathname);
    }

    /** 
     * Get full path with the constructor
     * 
     * @return unused
     * @test  
     */
    public function useGetFullpathWithConstructor()
    {

        $pathname="tmp/outputfiles/";
        $filename ="test.txt";
        $fullPath = $pathname . $filename;
        $newFile= new OutputFile($pathname, $filename);

        $this->assertEquals($newFile->getFullpath(), $fullPath);
    }

    /** 
     * Check the default padding char for strings
     * 
     * @return unused
     * @test  
     */
    public function checkDefaultPaddingCharString()
    {
        $newFile= new OutputFile();

        $this->assertEquals($newFile->getPaddingCharString(), " ");

        $newFile->setPaddingCharString("0");
        $this->assertEquals($newFile->getPaddingCharString(), "0");
    }

    
    /** 
     * Check the default padding char for integers
     * 
     * @return unused
     * @test  
     */
    public function checkDefaultPaddingCharInteger()
    {
        $newFile= new OutputFile();

        $this->assertEquals($newFile->getPaddingCharInteger(), "0");

        $newFile->setPaddingCharInteger(" ");
        $this->assertEquals($newFile->getPaddingCharInteger(), " ");
    }

    
    /** 
     * Check the default padding char for floats
     * 
     * @return unused
     * @test  
     */
    public function checkDefaultPaddingCharFloat()
    {
        $newFile= new OutputFile();

        $this->assertEquals($newFile->getPaddingCharFloat(), "0");

        $newFile->setPaddingCharFloat(" ");
        $this->assertEquals($newFile->getPaddingCharFloat(), " ");
    }
}
