<?php


namespace BMS\Controllers;


use BMS\Helper\Str;
use BMS\Models\AppUser;
use BMS\Plugins\SecurityPlugin;

/**
 * Class IndexController
 *
 * API Resource: Index
 *
 * @package BMS\Controllers
 */
class IndexController extends ControllerBase
{
    /** @var string Path to the API docs... */
    protected $apiDocsPath = '/api_doc/index.html';

    /**
     * Visiting the API for the first time?
     * Well, if you end up here, we will
     * send you to the API documentation
     * page so you can be familiar with
     * how to use our awesome API.. :)
     */
    public function indexAction()
    {
        // Prepare HTTP redirect to the API Docs page
        $this->response->redirect($this->apiDocsPath);

        // Send the response
        $this->response->send();
    }

    /**
     * Login User Action. This action allows a
     * user to login using valid credentials.
     * Only accepts POST requests...
     *
     * @api {post} /login Login a user
     * @apiName LoginUser
     * @apiGroup Users
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "email": "naruto@konoha.com",
     *          "password": "ramen@123" }' http://api.BMS.code/login
     *
     * @apiSuccess {Object} payload has information about the newly connected user
     *
     * @apiVersion 0.0.1
     */
    public function loginAction()
    {
        //$this->checkPost();

        // Fetch the Request data
        $data = $this->request->getJsonRawBody();
        $login = $data->email ?? null;
        $password = $data->password ?? null;

        // Attempt to retrieve a valid user
        $appUser = AppUser::findFirst([
            'conditions'    => 'email = :email: and password = :pass:',
            'bind'  => [
                'email'     => $login,
                'pass'      => $password
            ]
        ]);

        // If user with email doesn't exist
        if($appUser == null) {
            throw new \Exception(
                'Not a valid user', SecurityPlugin::CODE_ERROR_APP
            );
        }

        // Hashing of passwords disabled for API testing...
        /*// Check if password does not match the user's password hash
        if($this->security->checkHash($password, $appUser->password)) {
            throw new \Exception(
                'Not a valid user', SecurityPlugin::CODE_ERROR_APP
            );
        }*/

        // At the point, user is authorized. Lets return some info
        return [
            'user'  => $appUser,
            'token' => SecurityPlugin::generateJWToken($this->config, $appUser->userToken)
        ];
    }

    /**
     * Register User Action: This allows a
     * user to register an account with our
     * api. It only accepts POST requests
     *
     * @api {post} /register Registers a user
     * @apiName RegisterUser
     * @apiGroup Users
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "firstName": "Naruto",
     *          "lastName": "Uzumaki",
     *          "emailAddress": "naruto@konoha.com",
     *          "password": "ramen@123"
     *      }' http://api.BMS.code/register
     *
     * @apiSuccess {Object} payload returns the newly created user
     *
     * @apiVersion 0.0.1
     */
    public function registerAction()
    {
        // Retrieve Request data
        $data = $this->request->getJsonRawBody(true);

        // Create a new user object and assign
        // data from POST request.
        $appUser = new AppUser();
        $appUser->assign($data);

        // Attempt to create the record
        if(!$appUser->create()) {

            // If not successful
            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($appUser->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_APP
            );
        }

        // At the point, the user was successfully registered
        return [
            'user'  => $appUser,
            'token' => SecurityPlugin::generateJWToken($this->config, $appUser->userToken)
        ];
    }

    /**
     * Returns the system's health status. Only
     * accepts GET requests.
     *
     * @api {get} /health System Health Status
     * @apiName systemHealth
     * @apiGroup General
     *
     * @apiSuccess {Object} payload returns the system's health status
     *
     * @apiVersion 0.0.1
     */
    public function healthAction()
    {
        return [
            'status'    => 'The system is working properly, really :)...'
        ];
    }

}