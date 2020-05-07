<?php


namespace MovieSpace;

use GuzzleHttp\Exception\ServerException;
use MovieSpace\Plugins\SecurityPlugin;
use Phalcon\Session\Adapter\Files as Session;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class ApiClient
 *
 * A Custom API Client for send requests
 * to an external web service. Returned
 * data is transformed to JSON
 * automatically
 *
 * @package MovieSpace
 */
class ApiClient
{
    /**
     * Allowed HTTP Verbs
     */
    const ALLOWED_HTTP_METHODS = [
        'GET', 'POST', 'PUT', 'DELETE'
    ];

    const TOKEN_SESSION_KEY = 'token';

    /**
     * @var GuzzleClient A GuzzleHttp Client object
     */
    private $client;
    /**
     * @var Session A Session object
     */
    private $session;

    public function __construct($apiUrl = null, $session)
    {
        // Configure our API client
        $client = new GuzzleClient([
            'base_uri'  => $apiUrl,
            'timeout'   => 2,
            'headers'   => [
                'User-Agent'    => 'MovieSpaceWeb/1.0',
                'Accept'        => 'application/json'
            ]
        ]);

        $this->client = $client;
        $this->session = $session;
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

        // Include the JWT token in the request
        $parameters = array_merge($parameters, [
            'token'     => $this->session->get(self::TOKEN_SESSION_KEY)
        ]);

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
                    if(SecurityPlugin::CODE_ERROR_APP == $exception->getCode()) {
                        return new AppError(
                            $exception->getResponse()->getBody()->getContents()
                        );
                    }
                    throw new \Exception(
                        $exception->getResponse()->getBody()->getContents(), $exception->getCode()
                    );
                    break;

                default: // Any other type of exception
                    throw new \Exception($exception->getMessage(), $exception->getCode());

            }

        }

        $content = \GuzzleHttp\json_decode($response->getBody());

        return $content->payload;
    }

}