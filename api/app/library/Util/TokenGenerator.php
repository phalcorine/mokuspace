<?php


namespace BMS\Util;


use Phalcon\Exception;
use Phalcon\Security\Random;

/**
 * Class TokenGenerator
 *
 * Literally a token generator :)
 *
 * @package BMS\Util
 */
class TokenGenerator
{
    /**
     * @param string $prefix
     * @return string
     */
    public static function getTimedToken($prefix)
    {
        return $prefix . time();
    }

    /**
     * @param int $seed
     * @return string
     * @throws \Phalcon\Security\Exception
     */
    public static function getRandomNumbers($seed = 6)
    {
        $length = 6;
        if($seed != $length)
            $length = $seed;
        $random = new Random();
        $number = "";
        for($i = 0; $i < $length; $i++)
        {
            $coin = $random->number(9);
            $number .= $coin;
        }
        return $number;
    }
}