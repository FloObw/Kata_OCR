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
     * @param array $args Command Line Parameters
     *
     * @return void
     * @codeCoverageIgnore
     */
    public static function main($args)
    {
        $sampleFile = 'C:/Users/Florian/workspace/Kata_OCR/tests/library/Kata/SampleFile.txt';
        $fileData = new Kata_File($sampleFile);
        
        $dataLine = $fileData->parse();
        foreach ($dataLine as $line) {
            $accountnumber = new Kata_Accountnumber();
            foreach ($line as $char) {
                $digit = new Kata_Digit();                
                $digit->setOrgData($char);
                if (! is_numeric($digit->getDigitNumber())) {
                    $accountnumber->setIsreadable(false);
                }
                $accountnumber->setAccountNumber($digit->getDigitNumber());
            }
            $state = '';
            if ($accountnumber->getIsreadable() &&
            ! $accountnumber->isValidChecksum()) {
                $state = 'ERR';
            } elseif (! $accountnumber->getIsreadable()) {
                $state = 'ILL';
            }
            printf('%s %s %s', $accountnumber->getAccountNumber(), $state, PHP_EOL);
        }
    }
}
