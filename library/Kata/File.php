<?php

/**
 * Runner psoido main
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_File
{

    public $file = '';

    public $lineArray = array();

    public function __construct ($file)
    {
        $this->file = $file;
    }

    public function parse ()
    {
        if (file_exists($this->file)) {
            $this->file = fopen($this->file, "r");
            $this->getCharsAsArrayInLine($this->file);
        } else {
            echo 'Error file not found';
        }
        return $this->lineArray;
    }

    public function getCharsAsArrayInLine ($file)
    {
        $fileLine = 27;
        $digitLine = 1;
        if ($file) {
            while (! feof($file)) {
                $line = fgets($file);
                $line = str_replace("\r\n", "", $line);
                if (strlen($line) === $fileLine) {
                    $this->merge(str_split($line, 3), $digitLine);
                } else {
                    $digitLine ++;
                }
            }
            $this->close();
        }
    }

    /**
     */
    private function merge ($lineAsArray, $digitLine)
    {
        if (! isset($this->lineArray[$digitLine])) {
            $this->lineArray[$digitLine] = $lineAsArray;
        } else {
            
            foreach ($this->lineArray[$digitLine] as $key => $digits) {
                $digits = $digits;
                $this->lineArray[$digitLine][$key] .= $lineAsArray[$key];
            }
        }
    }

    /**
     * Close File Handler
     */
    public function close ()
    {
        fclose($this->file);
    }
}
