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
        }
        return $formattedField;
    } 


    private function formatInteger($value,$length,$alignment) {
        if(!empty($value)) {
            return sprintf("%".$this->outputFile->getPaddingCharInteger().$length."d", $value);
        } else {
            return substr(sprintf("%-".$length."s", " "), (-1*$length));
        }
    }

} 