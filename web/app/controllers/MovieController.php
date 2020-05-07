<?php


namespace MovieSpace\Controllers;



use MovieSpace\AppError;
use Phalcon\Paginator\Adapter\NativeArray as Paginator;
use Phalcon\Tag;

class MovieController extends ControllerBase
{
    // Define route constants...
    const API_ROUTE_MOVIE_ALL = 'movies';
    const API_ROUTE_MOVIE_CRUD = 'movie';

    // Define the pagination limit...
    const PAGINATION_LIMIT = 10;

    /**
     * Views all movies
     */
    public function indexAction()
    {
        Tag::appendTitle(' - All Movies');

        $content = $this->api->get(self::API_ROUTE_MOVIE_ALL);

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
     * Views the details of a single movie via
     * the Movie ID...
     */
    public function detailAction()
    {
        $movieId = $this->dispatcher->getParam('id');

        $content = $this->api->get(self::API_ROUTE_MOVIE_CRUD . '/' . $movieId);

        if($content instanceof AppError) {
            $this->view->setVar('errors', $content->getMessage());
        } else {
            $this->view->setVar('movie', $content->movie);
            $this->view->setVar('genres', $content->genres);
            $this->view->setVar('videos', $content->videos);
            $this->view->setVar('isFavorite', $content->isFavorite);
        }
    }
}