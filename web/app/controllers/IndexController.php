<?php


namespace MovieSpace\Controllers;


use MovieSpace\ApiClient;
use MovieSpace\AppError;
use MovieSpace\Forms\LoginForm;
use MovieSpace\Forms\RegisterForm;
use MovieSpace\Plugins\SecurityPlugin;
use Phalcon\Tag;

class IndexController extends ControllerBase
{
    // Define route constants...
    const ROUTE_HOME = 'movies';
    const API_ROUTE_HEALTH = 'health';
    const API_ROUTE_LOGIN = 'login';
    const API_ROUTE_REGISTER = 'register';

    /**
     * Login a user
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {
        // Sets the title of the page
        Tag::appendTitle(' - Login');

        $loginForm = null;

        // Check if this request is POST
        if($this->request->isPost()) {
            $loginForm = new LoginForm();

            // Validate request data with form
            if($loginForm->isValid($this->request->getPost())) {

                // Make an API request
                $content = $this->api->post(self::API_ROUTE_LOGIN, $this->request->getPost());

                // Check if payload was an error from the API
                if($content instanceof AppError) {
                    // Fetch the error messages and send to the view
                    $this->view->setVar('errors', $content->getMessage());
                } else {
                    // Login successful, fetch user details
                    $this->session->set(SecurityPlugin::USER_SESSION_KEY, $content->user);
                    $this->session->set(ApiClient::TOKEN_SESSION_KEY, $content->token);

                    // Redirect to logged in area
                    $this->response->redirect(self::ROUTE_HOME);
                    return $this->response->send();
                }
            } else {
                // Form validation failed... :(

                // Fetch form validation messages
                $messages = $loginForm->getMessages();
                $errors = '';

                foreach ($messages as $message) {
                    $errors .= '- ' . $message . '<br/>';
                }

                // Send error messages to the view
                $this->view->setVar('errors', $errors);
            }
        } else {
            $loginForm = new LoginForm(null);
        }

        $this->view->setVar('loginForm', $loginForm);
    }

    /**
     * Register a user
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function registerAction()
    {
        Tag::appendTitle(' - Register');

        $registerForm = null;

        // Check if its a POST request
        if($this->request->isPost()) {

            $registerForm = new RegisterForm();
            // Validate request data with the form
            if($registerForm->isValid($this->request->getPost())) {

                // Make API request
                $content = $this->api->post(self::API_ROUTE_REGISTER, $this->request->getPost());

                if($content instanceof AppError) {
                    // Seems some server errors occurred
                    $this->view->setVar('errors', $content->getMessage());
                } else {
                    // Everything seems fine, aka user was created.
                    // Fetch some user info
                    $this->session->set(SecurityPlugin::USER_SESSION_KEY, $content->user);
                    $this->session->set(ApiClient::TOKEN_SESSION_KEY, $content->token);

                    // Lets log the token
                    $this->logger->info(json_encode([
                        'token'     => $content->token
                    ]));

                    // Redirect the user to logged in area
                    $this->response->redirect(self::ROUTE_HOME);
                    return $this->response->send();
                }
            } else {
                // Form validation failed... :(

                // Fetch form validation messages
                $messages = $registerForm->getMessages();
                $errors = '';

                foreach ($messages as $message) {
                    $errors .= '- ' . $message . '<br/>';
                }

                // Send error messages to the view
                $this->view->setVar('errors', $errors);
            }
        } else {
            $registerForm = new RegisterForm(null);
        }

        $this->view->setVar('registerForm', $registerForm);
    }

    /**
     * Effectively logs out the user from
     * the current secured session.
     */
    public function logoutAction()
    {
        $this->session->destroy();

        $this->response->redirect('/');
    }

    /**
     * Checks the system health (API)
     */
    public function healthAction()
    {
        $content = $this->api->get(self::API_ROUTE_HEALTH);

        if($content instanceof AppError) {
            $this->view->setVar('errors', $content->getMessage());
        } else {
            $this->view->setVar('message', $content->status);
        }
    }
}