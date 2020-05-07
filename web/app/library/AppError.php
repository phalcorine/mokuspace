<?php


namespace MovieSpace;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use MovieSpace\Plugins\SecurityPlugin;

/**
 * Class AppError
 *
 * Represents an application error
 *
 * @package MovieSpace
 */
class AppError
{
    private $message;

    /**
     * AppError constructor. Accepts a
     * JSON Object. If the JSON object
     * is malformed, it throws an error.
     * @param $jsonMessage
     * @throws Exception
     */
    public function __construct($jsonMessage)
    {
        $response = json_decode($jsonMessage);

        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception(
                'JSON Malformed: ' . $jsonMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        $this->message = $response->message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}