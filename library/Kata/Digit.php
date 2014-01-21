<?php


/**
 * Runner psoido main
 * @package Kata
 * @author Florian Obwegs <florian.obwegs@raiffeisen.it>
 * @copyright Copyright (c) 2013 Raiffeisen OnLine Gen.
 */
class Kata_Digit
{

    private $orgData = array();

    private $isReadable = TRUE;

    private $digitNumber = Null;

    
    const zero = 'cd75cffc50934e0f53fef2c5d96ffd4a';

    const one = '75efd3f47945c39970e6cada35f86cfa';

    const two = 'f3ccbd590602fe75ee4d4bf2cbe35e39';

    const three = 'abb785ed4cb6dfac5229a3eab4c6c75f';

    const four = '03c5e0ce22a33f4ba6ea23f08533dc3b';

    const five = 'f088f7c46cd5d91c9bc4139438966bee';

    const six = 'd49830087fdd7a592cb2c68c9644835a';

    const seven = 'b138956a118e0d243845e8e52aba1821';

    const eight = '4e2218fb771032575ff72625d87ad8be';

    const nine = '769bf954f32466954054b19c6c6a9481';

    public function getOrgData ()
    {
        return $this->orgData;
    }

    public function setOrgData ($orgData)
    {
        $this->orgData = $orgData;
    }

    public function getIsReadable ()
    {
        return $this->isReadable;
    }

    public function setIsReadable ($isReadable)
    {
        $this->isReadable = $isReadable;
    }

   
    public function getDigitNumber ()
    {
       
        switch (md5($this->getOrgData())) {
            case Kata_Digit::zero:
                return 0;
            case Kata_Digit::one:
                return 1;
            case Kata_Digit::two:
                return 2;
            case Kata_Digit::three:
                return 3;
            case Kata_Digit::four:
                return 4;
            case Kata_Digit::five:
                return 5;
            case Kata_Digit::six:
                return 6;
            case Kata_Digit::seven:
                return 7;
            case Kata_Digit::eight:
                return 8;
            case Kata_Digit::nine:
                return 9;
            default:
                $this->setIsReadable(FALSE);
                return '?';
        }
    }
}