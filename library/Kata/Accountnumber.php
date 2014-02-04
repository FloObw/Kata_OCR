<?php

/**
 * AccountNumber Class foor check and transform
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_Accountnumber
{

    private $_isValidChecksum = FALSE;

    private $_isreadable = true;

    private $_accountNumber = '';
    
    private $_accountNumberAsArray = array();
    
    private $_possibleAccountNumbers = array();
    
    public $possibleReplacer = array(
            ' _ ',
            ' _|',
            '|_ ',
            '|_|',
            '| |',
            '  |'
    );
    
    /*
     * Getter for accountNumber return int accountNumber
     */
    public function getAccountNumber ()
    {
        $resString = '';
        foreach($this->_accountNumber as $accountNumber)
        {
            $resString .= $accountNumber->getDigitNumber();
        }
        return $resString;
    }
    
    /*
     * Getter for accountNumber return int accountNumber
    */
    public function getAccountNumberAsArray ()
    {
        return $this->_accountNumber;
    }
    
    public function getPossibleAccountNumber(){
        return $this->_possibleAccountNumbers;
    }
    
    public function addPossibleAccountNumber($possibleAccountNumber){
        (int)$possibleAccountNumber;
        if(!in_array($possibleAccountNumber, $this->_possibleAccountNumbers)){            
            $this->_possibleAccountNumbers[$possibleAccountNumber] = $possibleAccountNumber;           
        }
    }
    
    public function repair (){
        // for each Number in line
        //var_dump('NEW ACCOUNTNUMBER: '.$this->getAccountNumber());
        for ($counter = 0 ; $counter < count($this->_accountNumber); $counter++){
            $temp = $this;               
                //for each line in Char 
                foreach($temp->getAccountNumberAsArray() as $key => $charline)
                {
                    $orgCharData = $charline->getOrgDataAsArray();
                    //Replace char and try to validate            
                    foreach($this->possibleReplacer as $replacer){
                        $temp->_accountNumber[$counter]->setDataAsArray($replacer, $key);
                        if( is_numeric($temp->_accountNumber[$counter]->getDigitNumber()) 
                            
                        ){
                            $temp->isValidChecksum();                            
                        
                        }
                    }    
                    $temp->_accountNumber[$counter]->setDataAsArray($orgCharData);   
                    
            }
        }        
    }
    
    
    /*
     * Setter for accountNumber
     */
    public function setAccountNumber (Kata_Digit $accountNumber)
    {
        $this->_accountNumber[] = $accountNumber;
    }

    public function getIsreadable ()
    {
        return $this->_isreadable;
    }

    public function setIsreadable ($isreadable)
    {
        $this->_isreadable = $isreadable;
    }

    public function isValidChecksum ()
    {
        if ($this->getIsreadable()) {
            $this->calcChecksum();
            return $this->_isValidChecksum;
        }
    }

    public function setIsValidChecksum ($valid)
    {
        $this->_isValidChecksum = $valid;
    }

    public function calcChecksum ()
    {
        $reversedSplitNumber = array_reverse(
            str_split($this->getAccountNumber(), 1)
        );
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
            $this->addPossibleAccountNumber($this->getAccountNumber());            
        }        

    }
}