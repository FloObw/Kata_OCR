<?php

/**
 * AccountNumber Class foor check and transform
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_Accountnumber
{

    private $isValidChecksum = FALSE;

    private $isreadable = true;

    private $accountNumber = Null;
    
    /*
     * Getter for accountNumber return int accountNumber
     */
    public function getAccountNumber ()
    {
        return $this->accountNumber;
    }
    
    /*
     * Setter for accountNumber
     */
    public function setAccountNumber ($accountNumber)
    {
        $this->accountNumber .= $accountNumber;
    }

    public function getIsreadable ()
    {
        return $this->isreadable;
    }

    public function setIsreadable ($isreadable)
    {
        $this->isreadable = $isreadable;
    }

    public function isValidChecksum ()
    {
        if ($this->getIsreadable()) {
            $this->calcChecksum();
            return $this->isValidChecksum;
        }
    }

    public function setIsValidChecksum ($valid)
    {
        $this->isValidChecksum = $valid;
    }

    public function calcChecksum ()
    {
        $reversedSplitNumber = array_reverse(
                str_split($this->getAccountNumber(), 1));
        $sumVal = 0;
        $temp = 0;
        for ($i = 0; $i < count($reversedSplitNumber); $i ++) {
            $temp = $reversedSplitNumber[$i];
            if ($i == 0) {
                $sumVal = $temp;
            } else {
                $sumVal += (($i + 1) * $temp);
            }
        }
        
        // checksum calculation:
        if (($sumVal % 11) == 0) {
            $this->setIsValidChecksum(true);
        }
        
        // (d1+(2*d2) + (3*d3) + (4*d4) + (5*d5) +(6*d6) +(7*d7) + (8*d8) +
        // (9*d9) mod 11 = 0
    }
}