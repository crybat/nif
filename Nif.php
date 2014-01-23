<?php

/**
 * @link https://github.com/xi-project/xi-algorithm/blob/master/library/Xi/Algorithm/Luhn.php
 * @link http://forum.zwame.pt/showthread.php?t=401728&p=4348725&viewfull=1#post4348725
 */
class Nif {

    /**
     * Generates number with check digit
     *
     * @param integer $number
     * @return integer
     */
    public static function generate($number)
    {
        $number = (string) $number;

        $stack = 0;
        for ($i = 1; $i < 9; $i++) {
            $stack += $number[$i - 1] * (10 - $i);
        }

        $stack = 11 - ($stack % 11);

        return (int) ($number . ($stack >= 10 ? 0 : $stack));
    }

    /**
     * Validates the given number
     *
     * @param integer $number
     * @return boolean
     */
    public static function isValid($number)
    {
        if ( ! is_numeric($number) ||
             ! strlen($number) === 9 ||
             ! self::_isTypeCorrect($number)
        ) {
            return false;
        }

        $original = substr($number, 0, -1);

        return self::generate($original) === (int) $number;
    }

    public static function type($number)
    {
        return (int) ($number / 100000000);
    }

    /**
     * First digit must be one of these
     * @link http://pt.wikipedia.org/wiki/N%C3%BAmero_de_identifica%C3%A7%C3%A3o_fiscal
     *
     * @param integer $number
     * @return boolean
     */
    protected static function _isTypeCorrect($number)
    {
        return in_array(
            self::type($number),
            array(1, 2, 4, 5, 6 , 7, 8, 9),
            true
        );
    }

}