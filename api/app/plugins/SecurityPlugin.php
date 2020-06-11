<?php


namespace BMS\Plugins;


use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256 as JWTSigner;
use Lcobucci\JWT\Signer\Key as JWTSignerKey;
use Lcobucci\JWT\Token as JWToken;
use Phalcon\Config;
use Phalcon\Events\Event;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Dispatcher;

/**
 * Class SecurityPlugin
 *
 * This plugin serves as an event handler
 * for events fired by the dispatcher at
 * different times during a request/response
 * lifecycle. Also, some static methods are
 * included here useful for authentication
 * via JWT.
 *
 * @package BMS\Plugins
 */
class SecurityPlugin extends PluginBase
{
    /**
     * Define HTTP Error Codes constants
     */
    const CODE_ERROR_APP            = 508;
    const CODE_ERROR_SERVER         = 500;
    const CODE_ERROR_NOT_FOUND      = 404;
    const CODE_ERROR_ACCESS_DENIED  = 401;
    const CODE_SUCCESS              = 200;

    /**
     * Other constants
     */
    const USER_ID_TOKEN_KEY = 'app_user_token';

    /**
     * Before handling an external request
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeHandleRoute(Event $event, Dispatcher $dispatcher)
    {
        //@TODO: Check incoming IPs and create whitelist for allowed hosts

        // === CORS ===
        $requestOrigin = "*";

        if($this->request->getHeader('ORIGIN')) {
            $requestOrigin = $this->request->getHeader('ORIGIN');
        }

        /**
         * Since this is an API service that would potentially be used
         * be an external consumer, we should add some CORS (Cross Origin
         * Resource Sharing) information.
         */
        $this->response
            ->setHeader('Access-Control-Allow-Origin', $requestOrigin)
            ->setHeader(
                'Access-Control-Allow-Methods',
                'GET, PUT, POST, DELETE, OPTIONS'
            )
            ->setHeader('Access-Control-Allow-Headers',
                'Origin, X-Requested-With, Content-Range, ' .
                'Content-Disposition, Content-Type, Authorization'
            )
            ->setHeader('Access-Control-Allow-Credentials', 'true');

        return true;
    }

    /**
     * Before executing the route...
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     * @throws \Exception
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        /**
         * Checks to see if the JSON request object received is malformed
         */
        $parameters = $this->request->getRawBody();

        if($parameters !== '') {
            // Check data received
            if(JSON_ERROR_NONE !== json_last_error()) {
                throw new \Exception('JSON malformed. Please check and try again',
                    self::CODE_ERROR_SERVER);
            }
        }

        return true;
    }

    /**
     * Throws an exception if api url route is not found
     * @throws \Exception
     */
    public function beforeNotFoundAction()
    {
        throw new \Exception('Not Found', self::CODE_ERROR_NOT_FOUND);
    }

    /**
     * Converts Exceptions (caused withing the application)
     * into the appropriate JSON responses
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @param \Exception $exception
     * @return ResponseInterface
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, \Exception $exception)
    {
        // Default Exception: Server Error (500)
        $statusCode = self::CODE_ERROR_SERVER;
        $messageStatus = 'Server Error';

        // Check if any other exception occurred
        $otherException = in_array($exception->getCode(), [
            self::CODE_ERROR_ACCESS_DENIED,
            self::CODE_ERROR_NOT_FOUND,
            self::CODE_ERROR_APP
        ]);

        // If there are other types of exception, replace the default
        // status code and message
        if($otherException == true) {
            $statusCode = $exception->getCode();
            $messageStatus = $exception->getMessage();
        }

        /**
         * Create a JSON Response with the
         * exception details...
         */
        $this->response->setJsonContent([
            'code'      => $statusCode,
            'status'    => 'error',
            'message'   => $messageStatus
        ]);

        /**
         * Sets the status code (and message)
         */
        $this->response->setStatusCode($statusCode, $messageStatus);

        // Return the response...
        return $this->response->send();
    }

    /**
     * Effectively generates a new JWT token for user
     * authentication.
     * This token is signed with the security key
     * specified in the /app/config/config.php file.
     * @param Config $config
     * @param $userIdToken
     * @return bool|mixed
     */
    public static function generateJWToken($config, $userIdToken)
    {
        // Get the application security key from shared config
        $appSecurityKey = $config->path('security.key');

        return (new Builder())
            ->withClaim(self::USER_ID_TOKEN_KEY, $userIdToken)
            ->issuedAt(time())
            ->getToken(new JWTSigner(), new JWTSignerKey($appSecurityKey))
            ->__toString();
    }

    /**
     * Retrieves the user id of the user by using
     * the JWT token.
     * This token is verified with the security key
     * specified in the /app/config/config.php file.
     * @param Config $config
     * @param $jwToken
     * @return bool|mixed
     */
    public static function getUserIdFromToken($config, $jwToken)
    {
        // Get the application security key from shared config
        $appSecurityKey = $config->path('security.key');
        // Parse the token
        $token = (new Parser())->parse($jwToken);
        if($token instanceof JWToken &&
            $token->verify(new JWTSigner(), $appSecurityKey)
        ) {
            return $token->getClaim(self::USER_ID_TOKEN_KEY);
        }

        return false;
    }
}