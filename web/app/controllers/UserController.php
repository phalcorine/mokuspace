<?php


namespace MovieSpace\Controllers;


use MovieSpace\AppError;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;
use Phalcon\Tag;

class UserController extends ControllerBase
{
    // Define route constants...
    const API_ROUTE_USER = 'user';
    const API_ROUTE_USER_MOVIES = 'user/movies';

    // Define pagination limit
    const PAGINATION_LIMIT = 10;

    /**
     * List all user favorite movies
     */
    public function moviesAction()
    {
        // Set page title
        Tag::appendTitle(' - Favorite Movies');

        // Send request
        $content = $this->api->get(self::API_ROUTE_USER_MOVIES);

        // Check for errors
        if($content instanceof AppError) {
            $this->view->setVar('errors', $content->getMessage());
        } else {

            /**
             * Prepare paginated records...
             */
            // Initial page
            $pageNumber = 1;

            // Check if request comes with specific page number
            if($this->request->hasQuery('page')) {
                // Sanitize query parameter as 'int'
                $pageNumber = $this->request->getQuery('page', 'int');
            }

            // Initialize paginator
            $paginator = new Paginator([
                'data'  => $content->movies, // data to be paginated
                'limit' => self::PAGINATION_LIMIT,
                'page'  => $pageNumber
            ]);

            // Load the paginator into the view
            $this->view->setVar('page', $paginator->paginate());
        }
    }

    /**
     * Adds a movie to user favorites
     */
    public function movieFavAction()
    {
        // Fetch the movie's id from the request
        $movieId = $this->dispatcher->getParam('id');

        // Send Request...
        $content = $this->api->get(self::API_ROUTE_USER_MOVIES . '/fav/' . $movieId);

        // Check if any server errors occurred
        if($content instanceof AppError) {
            $this->view->setVar('errors', $content->getMessage());
        } else {
            $status = $content->status;

            if($status == true) {
                $this->flashSession->success('Movie added to favorites successfully...');
            } else {
                $this->flashSession->error('Something went wrong...');
            }
        }

        // Prepare response
        $redirectRoute = 'movie/' . $movieId;
        $this->response->redirect($redirectRoute);

        // Send response
        $this->response->send();
    }

    /**
     * Removes a movie from user user favorites
     *
     */
    public function movieUnFavAction()
    {
        // Fetch the movie's id from the request
        $movieId = $this->dispatcher->getParam('id');

        // Send Request...
        $content = $this->api->get(self::API_ROUTE_USER_MOVIES . '/unfav/' . $movieId);

        // Check if any server errors occurred
        if($content instanceof AppError) {
            $this->view->setVar('errors', $content->getMessage());
        } else {
            $status = $content->status;

            if($status == true) {
                $this->flashSession->success('Movie removed to favorites successfully...');
            } else {
                $this->flashSession->error('Something went wrong...');
            }
        }

        // Prepare response
        $redirectRoute = 'movie/' . $movieId;
        $this->response->redirect($redirectRoute);

        // Send response
        $this->response->send();
    }
}