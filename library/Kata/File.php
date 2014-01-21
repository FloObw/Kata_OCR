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
        $data = array();
        $this->file = fopen($this->file, "r");
        $this->getCharsAsArrayInLine($this->file);
        return  $this->lineArray;
    }

    public function getCharsAsArrayInLine ($file)
    {
        $fileLine = 0;
        $digitLine = 1;
        while (! feof($file)) {
            $line = fgets($file);
            $line = str_replace("\r\n", "", $line);
            if (strlen($line) === 27) {
                $this->merge(str_split($line, 3), $digitLine);
            }             // New Line
            else {
                $digitLine ++;
            }
        }
        
        $this->close();
    }

    /**
     */
    private function merge ($lineAsArray, $digitLine)
    {
        if (! isset($this->lineArray[$digitLine])) {
            $this->lineArray[$digitLine] = $lineAsArray;
        } else {
            
            foreach ($this->lineArray[$digitLine] as $key => $digits) {
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
