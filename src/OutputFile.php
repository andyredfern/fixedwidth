<?php
/**
 * OutputFile class file
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
 * Class OutputFile 
 * 
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputFile
{

    private $_filename;
    private $_pathname;
    private $_paddingCharString=" ";
    private $_paddingCharInteger="0";
    private $_paddingCharFloat="0";

    /**
     * Create a new OutputFile Instance
     * 
     * @param String $pathname path of where the data will be saved
     * @param String $filename file in which the data will be saved
     */
    function __construct($pathname="",$filename="")
    {
        $this->_filename = $filename;
        $this->_pathname = $pathname;
    }

    /**
     * Set filename
     * 
     * @param String $filename file in which the data will be saved
     * 
     * @return true
     */
    function setFilename($filename)
    {
        $this->_filename = $filename;
        return true;
    }

    /**
     * Get filename
     * 
     * @return String $_filename file in which the data will be saved
     */
    function getFilename()
    {
        return $this->_filename;
    }

    /**
     * Set pathanme
     * 
     * @param String $pathname path of where the data will be saved
     * 
     * @return true
     */
    function setPathname($pathname)
    {
        $this->_pathname = $pathname;
        return true;
    }

    /**
     * Get filename
     * 
     * @return String $_pathname path of where the data will be saved
     */
    function getPathname()
    {
        return $this->_pathname;
    }

    /**
     * Get full pathanme
     * 
     * @return String full pathname and filename comvbined
     */   
    function getFullPath()
    {
        return $this->_pathname . $this->_filename;
    }

    /**
     * Get paddingChar for strings
     * 
     * @return String _paddingCharString paddingChar for strings
     */    
    function getPaddingCharString()
    {
        return $this->_paddingCharString;
    }

    /**
     * Set paddingChar for strings 
     * 
     * @param String $paddingChar char for padding all strings
     * 
     * @return true
     */
    function setPaddingCharString($paddingChar)
    {
        $this->_paddingCharString = $paddingChar;
        return true;
    }

    /**
     * Get paddingChar for integer
     * 
     * @return String _paddingCharInteger paddingChar for integer
     */
    function getPaddingCharInteger()
    {
        return $this->_paddingCharInteger;
    }

    /**
     * Set paddingChar for integer 
     * 
     * @param String $paddingChar char for padding all integers
     * 
     * @return true
     */
    function setPaddingCharInteger($paddingChar)
    {
        $this->_paddingCharInteger = $paddingChar;
        return true;
    }

    /**
     * Get paddingChar for floating point numbers 
     * 
     * @return String _paddingCharFloat paddingChar for floating point numbers 
     */
    function getPaddingCharFloat()
    {
        return $this->_paddingCharFloat;
    }

    /**
     * Set paddingChar for floating point numbers 
     * 
     * @param String $paddingChar char for padding all floating point numbers 
     * 
     * @return true
     */
    function setPaddingCharFloat($paddingChar)
    {
        $this->_paddingCharFloat = $paddingChar;
    }
}
