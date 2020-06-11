<?php


namespace BMS\Helper;

/**
 * Class Str
 *
 * Contains useful string manipulation
 * functions...
 *
 * @package BMS\Helper
 */
class Str
{
    /**
     * Generates a dot separated string from an iterable
     * object. If the object isn't iterable, it returns
     * an empty string.
     * @param $data
     * @return string
     */
    public static function getDotSeparatedStringFromIterable($data)
    {
        if(!is_iterable($data)) {
            return "";
        }

        $payload = "";

        foreach ($data as $datum) {
            $payload .= ' ' . $datum . '.';
        }

        return $payload;
    }
}