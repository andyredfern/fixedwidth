<?php

namespace Andyredfern\Fixedwidth;

/**
 * Class OutputFile
 *
 * @package Andyredfern\Fixedwidth
 */

class OutputFile 
{

    private $filename;
    private $pathname;
    private $paddingCharString=" ";
    private $paddingCharInteger="0";


    function __construct($pathname="",$filename="") {
        $this->filename = $filename;
        $this->pathname = $pathname;
    }

    function setFilename($filename) {
        $this->filename = $filename;
    }

    function getFilename() {
        return $this->filename;
    }

    function setPathname($pathname) {
        $this->pathname = $pathname;

    }

    function getPathname() {
        return $this->pathname;
    }

    function getFullPath() {
        return $this->pathname . $this->filename;
    }

    function getPaddingCharString() {
        return $this->paddingCharString;
    }

    function setPaddingCharString($PaddingChar) {
        $this->paddingCharString = $paddingChar;
    }

    function getPaddingCharInteger() {
        return $this->paddingCharInteger;
    }

    function setPaddingCharInteger($PaddingChar) {
        $this->paddingCharInteger = $paddingChar;
    }
}