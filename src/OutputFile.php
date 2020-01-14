<?php

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


    function __construct($pathname="",$filename="")
    {
        $this->_filename = $filename;
        $this->_pathname = $pathname;
    }

    function setFilename($filename)
    {
        $this->_filename = $filename;
    }

    function getFilename()
    {
        return $this->_filename;
    }

    function setPathname($pathname)
    {
        $this->_pathname = $pathname;

    }

    function getPathname()
    {
        return $this->_pathname;
    }

    function getFullPath()
    {
        return $this->_pathname . $this->_filename;
    }

    function getPaddingCharString()
    {
        return $this->_paddingCharString;
    }

    function setPaddingCharString($paddingChar)
    {
        $this->_paddingCharString = $paddingChar;
    }

    function getPaddingCharInteger()
    {
        return $this->_paddingCharInteger;
    }

    function setPaddingCharInteger($paddingChar)
    {
        $this->_paddingCharInteger = $paddingChar;
    }

    function getPaddingCharFloat()
    {
        return $this->_paddingCharFloat;
    }

    function setPaddingCharFloat($paddingChar)
    {
        $this->_paddingCharFloat = $paddingChar;
    }
}