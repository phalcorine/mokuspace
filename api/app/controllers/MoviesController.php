<?php


namespace BMS\Controllers;

use BMS\Models\AppUser;
use BMS\Models\Movie;
use BMS\Models\UserMovieFavorite;
use BMS\Plugins\SecurityPlugin;

/**
 * Class MoviesController
 * API Resource: Movie
 * @package BMS\Controllers
 */
class MoviesController extends ControllerBase
{

    /**
     * Fetches all the movies available
     *
     * @api {get} /movies Fetches all movies
     * @apiName allMovies
     * @apiGroup Movies
     * @apiExample Example of use:
     *      curl -i -X GET http://api.BMS.code/movies
     *
     * @apiSuccess {Object} payload A json array of movies
     *
     * @apiVersion 0.0.1
     */
    public function allMoviesAction()
    {
        // Fetches all movies
        $movies = Movie::find();

        // Return the response...
        return [
            'movies'    => $movies
        ];
    }

    /**
     * Gets information about a movie. This action
     * only accepts GET requests...
     *
     * @api {get} /movie/:id Fetches a single movie
     * @apiParam {Integer} id The ID of the movie to
     *  be returned
     * @apiName infoMovie
     * @apiGroup Movies
     * @apiExample Example of use:
     *      curl -i -X GET -d '{"token": "..."}' http://api.BMS.code/movie/3
     *
     * @apiSuccess {Object} payload Fetches information about the movie
     *
     * @apiVersion 0.0.1
     */
    public function infoAction()
    {
        // Status for user movie favorite
        $isUserFavorite = false;

        // Fetch the id sent as a parameter
        // with the request
        $movieId = $this->dispatcher->getParam('id');

        // Fetch the user details using the token passed
        // when sending the request. This info would be used
        // to determine if the user currently has this movie
        // (if found) as favorite
        /** @var AppUser $user */
        $user = $this->di->get('user');

        // Attempt to get a movie from the database
        $movie = Movie::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $movieId
            ]
        ]);

        // Throw an error message if a movie with such id wasn't found...
        if($movie == null) {
            throw new \Exception(
                "Movie with id: {$movieId} not found.", SecurityPlugin::CODE_ERROR_SERVER);
        } elseif ($user != null) {

            // The user exist at this point. Lets check if the movie
            // was added as favorite by the user
            $count = UserMovieFavorite::count([
                'conditions'    => 'userId = :uId: and movieId = :mId:',
                'bind'  => [
                    'uId'   => $user->id,
                    'mId'   => $movie->id
                ]
            ]);

            // If we find an entry, then this movie
            // is a user favorite
            if($count > 0) {
                $isUserFavorite = true;
            }
        }

        // Return response
        return [
            'movie'             => $movie,
            'genres'            => $movie->getGenres(),
            'videos'             => $movie->getVideos(),
            'isFavorite'    => $isUserFavorite
        ];
    }


}