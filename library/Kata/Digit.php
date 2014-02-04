<?php


/**
 * Runner psoido main
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_Digit
{

    private $_orgData = array();
    
    private $_orgDataAsArray = array();

    private $_isReadable = TRUE;

    private $_digitNumber = Null;

    private $_numberCombination = array (
                'cd75cffc50934e0f53fef2c5d96ffd4a' => 0,
                '75efd3f47945c39970e6cada35f86cfa' => 1,
                'f3ccbd590602fe75ee4d4bf2cbe35e39' => 2,
                'abb785ed4cb6dfac5229a3eab4c6c75f' => 3,
                '03c5e0ce22a33f4ba6ea23f08533dc3b' => 4,
                'f088f7c46cd5d91c9bc4139438966bee' => 5,
                'd49830087fdd7a592cb2c68c9644835a' => 6,
                'b138956a118e0d243845e8e52aba1821' => 7,
                '4e2218fb771032575ff72625d87ad8be' => 8,
                '769bf954f32466954054b19c6c6a9481' => 9
            );

    public function getOrgData ()
    {
        $data = $this->getOrgDataAsArray();
        if(!empty($data)){
            return implode('', $data);
        }
        return $this->_orgData;
    }

    public function setOrgData ($orgData)
    {
        $this->_orgData = $orgData;
    }

    public function getOrgDataAsArray ()
    {
        return $this->_orgDataAsArray;
    }

    public function setDataAsArray ($orgData, $iterator = NULL)
    {
        
        if($iterator !== NULL)
        {
            $this->_orgDataAsArray[$iterator] =  $orgData;
        }
        else{
            $this->_orgDataAsArray = $orgData;
        }        
        
    }
        
    public function getIsReadable ()
    {
        return $this->_isReadable;
    }

    public function setIsReadable ($isReadable)
    {
        $this->_isReadable = $isReadable;
    }

    public function getDigitNumber ()
    {
        $hashVal =  md5($this->getOrgData());
        if (array_key_exists($hashVal, $this->_numberCombination)) {
            $this->_digitNumber = 
                $this->_numberCombination[md5($this->getOrgData())];
        } else {
            $this->setIsReadable(FALSE);
            $this->_digitNumber = '?';
        }
        return $this->_digitNumber;
    }
}