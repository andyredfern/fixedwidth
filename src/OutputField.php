<?php

namespace Andyredfern\Fixedwidth;

/**
 * Class OutputField
 *
 * @package Andyredfern\Fixedwidth
 */

class OutputField {

    private $outputFile;

    function __construct($outputFile) {
        $this->outputFile = $outputFile;
    }

    function outputField($fieldSpec,$value) {
        switch($fieldSpec["type"]) {
            case "i":
                $formattedField=$this->formatInteger($value,$fieldSpec["len"],$fieldSpec["align"]);
                break;
            case "s":
                ## TODO
            case "d":
                $formattedField=$this->formatDate($value,$fieldSpec["len"],$fieldSpec["align"],$fieldSpec["format"]);
                break;

        }
        return $formattedField;
    } 


    private function formatInteger($value,$length,$alignment) {
        if(!empty($value)) {
            return sprintf("%".$this->outputFile->getPaddingCharInteger().$length."d", $value);
        } else {
            return substr(sprintf("%-".$length."s", $this->outputFile->getPaddingCharString()), (-1*$length));
        }
    }

    private function formatDate($value,$length,$alignment,$format="Ymd") {
        if(!empty($value)) {
            return date($format, strtotime($value));
        }
        //no date, but we need the padding
        return substr(sprintf("%-".$length."s", $this->outputFile->getPaddingCharString()), (-1*$length));
    }


} 