<?php

namespace Andyredfern\Fixedwidth;

/**
 * OutputField Class Doc Comment
 * 
 * @category Class
 * @package  Andyredfern\Fixedwidth
 * @author   Andy Redfern <and@redfern.it>
 * @license  MIT License (MIT)
 * @link     https://github.com/andyredfern/fixedwidth
 */
class OutputField
{
    /**
     * The linked output file where the formatted fields will be saved
     * 
     * @var class $_outputFile of type Outpufile
     */
    private $_outputFile; 
    
    /**
     * Create a new OutputField Instance
     * 
     * @param Class $outputFile where the data will be saved
     */
    function __construct($outputFile)
    {
        $this->_outputFile = $outputFile;
    }

    /**
     * Public function that process the $value and returns a 
     * formatted, fixed-length string
     * 
     * @param array $fieldSpec The parameters to control the output
     * @param $value     can be a string, integer, floating point or date
     * 
     * @return string formatted string of the submitted $value
     */
    function outputField($fieldSpec, $value)
    {
        switch($fieldSpec["type"]) {
        case "i": // integer
            $formattedField=$this->_formatInteger($value, $fieldSpec["len"], $fieldSpec["align"]);
            break;
        case "f": // floating point
            $formattedField=$this->_formatFloat($value, $fieldSpec["len"], $fieldSpec["align"]);
            break;
        case "s": // string
            $formattedField=$this->_formatString($value, $fieldSpec["len"], $fieldSpec["align"]);
            break;
        case "d": // date
            $formattedField=$this->_formatDate($value, $fieldSpec["len"], $fieldSpec["align"], $fieldSpec["format"]);
            break;
        }
        return $formattedField;
    } 

    /**
     * Private function to return fixed length string with a formatted integer
     * 
     * @param $value     can be a string, integer, floating point or date
     * @param integer $length    length of final field
     * @param string  $alignment alignment of $value in final field
     * 
     * @return string formatted string of the submitted integer $value
     */  
    private function _formatInteger($value, $length, $alignment)
    {
        if (!empty($value)) {
            return sprintf("%".$this->_outputFile->getPaddingCharInteger().$length."d", $value);
        } else {
            return substr(sprintf("%-".$length."s", $this->_outputFile->getPaddingCharString()), (-1*$length));
        }
    }

    /**
     * Private function to return fixed length string with a 
     * formatted floating point number
     * 
     * @param $value     can be a string, integer, floating point or date
     * @param integer $length    length of final field
     * @param string  $alignment alignment of $value in final field
     * 
     * @return string formatted string of the submitted flaoating number $value
     */
    private function _formatFloat($value, $length, $alignment)
    {
        if (!empty($value)) {
            if (strpos($value, '^') > 0) {
                $expArr = explode('^', $value);
                print_r($expArr);
            }
                //$temp = $this->formatString($value, str_replace('^', '.', $value), $length+1);
             //   return str_replace('.', '', $temp);
            //} else {
                $tArr = explode('.', $value);
                print_r($tArr);
                return sprintf('%'.$this->_outputFile->getPaddingCharFloat().$length.'.'.strlen($tArr[1]).'f', $value);
            //}            
        } else {
            return substr(sprintf("%-".$length."s", $this->_outputFile->getPaddingCharString()), (-1*$length));
        }
    }

    /**
     * Private function to return fixed length string with a 
     * formatted date
     * 
     * @param $value     can be a string, integer, floating point or date
     * @param integer $length    length of final field
     * @param string  $alignment alignment of $value in final field
     * @param string  $format    the date format
     * 
     * @return string formatted string of the submitted date $value
     */
    private function _formatDate($value, $length, $alignment, $format="Ymd")
    {
        if (!empty($value)) {
            return date($format, strtotime($value));
        }
        //no date, but we need the padding
        return substr(sprintf("%-".$length."s", $this->_outputFile->getPaddingCharString()), (-1*$length));
    }

    /**
     * Private function to return fixed length string with a 
     * string
     * 
     * @param $value     can be a string, integer, floating point or date
     * @param integer $length    length of final field
     * @param string  $alignment alignment of $value in final field
     * 
     * @return string formatted string of the submitted string $value
     */
    private function _formatString($value,$length,$alignment)
    {
        return substr(sprintf("%-".$length."s", $value), (-1*$length));
    }
    

} 