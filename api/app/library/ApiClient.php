<?php


namespace BMS;

use GuzzleHttp\Exception\ServerException;
use BMS\Plugins\SecurityPlugin;
use Phalcon\Session\Adapter\Files as Session;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class ApiClient
 *
 * An API Client simplified for the
 * console application.
 *
 * @package BMS
 */
class ApiClient
{
    /**
     * Allowed HTTP Verbs
     */
    const ALLOWED_HTTP_METHODS = [
        'GET', 'POST', 'PUT', 'DELETE'
    ];

    /**
     * @var GuzzleClient A GuzzleHttp Client object
     */
    private $client;

    public function __construct($apiUrl = null)
    {
        // Configure our API client
        $client = new GuzzleClient([
            'base_uri'  => $apiUrl,
            'timeout'   => 2,
            'headers'   => [
                //'User-Agent'    => 'BMSApi/1.0',
                'Accept'        => 'application/json'
            ]
        ]);

        $this->client = $client;
    }

    public function __call($httpMethod, $arguments)
    {
        // Retrieve the route
        $route = $arguments[0];
        $parameters = [];

        // Check if we have arguments when calling
        if(count($arguments) > 1) {
            $parameters = $arguments[1];
        }

        $httpMethod = strtoupper($httpMethod);

        // Check if the http verb amongst those allowed
        if(!in_array($httpMethod, self::ALLOWED_HTTP_METHODS)) {
            throw new \Exception(
                "The method {$httpMethod} is not allowed", SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        try {
            // Sending the request to the API and
            // expecting a possible response
            $response = $this->client->request(
                $httpMethod, $route, [
                    'json'  => $parameters
                ]
            );
        } catch (\Exception $exception) {

            switch (get_class($exception)) {
                case 'GuzzleHttp\Exception\ClientException':
                case 'GuzzleHttp\Exception\ServerException':

                    /**
                     * If its an exception generated from the Guzzle
                     * HTTP client itself, the we should fetch its
                     * exception details before handling the error
                     * ourselves...
                     */

                    /** @var ServerException $exception */
                    throw new \Exception(
                        $exception->getResponse()->getBody()->getContents(), $exception->getCode()
                    );
                    break;

                default: // Any other type of exception
                    throw new \Exception($exception->getMessage(), $exception->getCode());

            }

        }

        $content = $response->getBody();

        return $content;
    }

}