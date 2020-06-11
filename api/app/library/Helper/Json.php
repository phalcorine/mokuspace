<?php


namespace BMS\Helper;


use Phalcon\Http\RequestInterface;

/**
 * Class Json
 *
 * Contains useful JSON manipulation
 * functions...
 *
 * @package BMS\Helper
 */
class Json
{
    /**
     * Retrieves a JSON Raw Body from a
     * Phalcon HTTP Request object...
     * @param RequestInterface $request
     * @param bool $associative
     * @return bool
     */
    public static function getJsonRawBodyFromHttpRequest(RequestInterface $request, $associative = false)
    {
        $rawBody = $request->getRawBody();

		if (empty($rawBody)) {
            return false;
        }

		$data = json_decode($rawBody, $associative);

		if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

		return $data;
    }

    /**
     * Decodes a value to JSON
     * @param $value
     * @return mixed
     */
    public static function decode($value)
    {
        return json_decode($value);
    }
}