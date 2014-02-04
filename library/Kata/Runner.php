<?php

/**
 * Runner psoido main
 *
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_Runner
{
    /**
     * Main entry point for Kata example psoido main
     *
     *
     * @return void
     * @codeCoverageIgnore
     */
    public static function main()
    {
        //$filePath = 'C:\workspace\kata-florian\tests\library\Kata';
        $filePath = 'C:\Users\Florian\workspace\Kata_OCR\tests\library\Kata';
        $sampleFile = $filePath.'\SampleFile.txt';
        $fileData = new Kata_File($sampleFile);
        
        foreach ($fileData->parse() as $line) {
            $accountnumber = new Kata_Accountnumber();
            foreach ($line as $char) {
                $digit = new Kata_Digit();                
                $digit->setOrgData($char);
                $digit->setDataAsArray(str_split($char, 3));
              
                if (! is_numeric($digit->getDigitNumber())) {
                    $accountnumber->setIsreadable(false);
                }
                $accountnumber->setAccountNumber($digit);
            }
            $state = '';
            $possibilities = '';
            
            
            if ($accountnumber->getIsreadable() &&
            ! $accountnumber->isValidChecksum()) {
                $state = 'ERR';
            } elseif (! $accountnumber->getIsreadable()) {
                $state = 'ILL';
            }
            
            //If some error or not readable
            if( $state == 'ERR' && $accountnumber->getIsreadable() && ! $accountnumber->isValidChecksum())
            {
                //Try to change elements
                $accountnumber->repair();
                if(count($accountnumber->getPossibleAccountNumber())){
                    $state = 'AMB';
                    $possibilities = ' ['. implode (' ,',$accountnumber->getPossibleAccountNumber()).']';
                }
            }
            
            
            printf(
                '%s %s %s %s',
                $accountnumber->getAccountNumber(),
                $state,
                $possibilities,
                PHP_EOL
            );
        }
    }
}
