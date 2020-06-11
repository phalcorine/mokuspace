<?php


namespace BMS\Controllers;


use BMS\Models\AppUser;
use BMS\Models\Movie;
use BMS\Models\UserMovieFavorite;
use BMS\Plugins\SecurityPlugin;

/**
 * Class UserController
 * API Resource: User
 * @package BMS\Controllers
 */
class UserController extends ControllerBase
{
    public function indexAction()
    {

    }

    /**
     * List all user favorite movies
     *
     * @api {get} /user/movies List all user favorite movies
     * @apiName userMoviesAll
     * @apiGroup User
     * @apiExample Example of use:
     *      curl -i -X GET -d '{"token": "..."}' http://api.BMS.code/user/movies
     *
     * @apiSuccess {Object} payload Returns list of favorite movies
     *
     * @apiVersion 0.0.1
     */
    public function moviesAction()
    {
        // Get the user
        /** @var AppUser $user */
        $user = $this->di->get('user');

        // Fetch user favorite movies
        $userFavMovies = $user->getFavoriteMovies();

        // Return response
        return [
            'movies'    => $userFavMovies
        ];
    }

    /**
     * Adds a movie to user favorites
     *
     * @api {get} /user/movies/fav/:id Adds a movie to user favorites
     * @apiParam {Integer} id The id of the movie
     * @apiName userMovieFav
     * @apiGroup User
     * @apiExample Example of use:
     *      curl -i -X GET -d '{"token": "..."}' http://api.BMS.code/user/movies/fav/3
     *
     * @apiSuccess {Object} payload Favorite status
     *
     * @apiVersion 0.0.1
     */
    public function movieFavAction()
    {
        // Request status
        $isSuccess = false;

        // Fetch the movie's id, from route
        $movieId = $this->dispatcher->getParam('id');

        // Fetch the movie, if available.
        $movie = Movie::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $movieId
            ]
        ]);

        // Check if movie was fetched
        if($movie == null) {
            throw new \Exception(
                "Movie with id: {$movieId} not found", SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        /** @var AppUser $user */
        $user = $this->di->get('user');

        // Check if this movie is favorite already
        $favCount = UserMovieFavorite::count([
            'conditions'    => 'movieId = :mId: and userId = :uId:',
            'bind'  => [
                'mId'   => $movie->id,
                'uId'   => $user->id
            ]
        ]);

        // Add to favorite if no record exists...
        if($favCount < 1) {
            $favMovie = new UserMovieFavorite();
            $favMovie->movieId = $movie->id;
            $favMovie->userId = $user->id;
            if($favMovie->create()) {
                $isSuccess = true;
            }
        }

        // Return response...
        return [
            'status'    => $isSuccess
        ];
    }

    /**
     * Removes a movie from user user favorites
     *
     * @api {get} /user/movies/unfav/:id Removes a movie from user favorites
     * @apiParam {Integer} id The id of the movie
     * @apiName userMovieUnfav
     * @apiGroup Movies
     * @apiExample Example of use:
     *      curl -i -X GET -d '{"token": "..."}' http://api.BMS.code/user/movies/unfav/3
     *
     * @apiSuccess {Object} payload Favorite Status
     *
     * @apiVersion 0.0.1
     */
    public function movieUnFavAction()
    {
        $isSuccess = false;

        // Fetch the movie's id, from route
        $movieId = $this->dispatcher->getParam('id');

        // Fetch the movie, if available
        $movie = Movie::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $movieId
            ]
        ]);

        // Check if the movie was not found
        if($movie == null) {
            throw new \Exception(
                "Movie with id: {$movieId} not found", SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Get user
        /** @var AppUser $user */
        $user = $this->di->get('user');

        // Check if the movie is amongst favorites
        $favorite = UserMovieFavorite::findFirst([
            'conditions'    => 'movieId = :mId: and userId = :uId:',
            'bind'  => [
                'mId'   => $movieId,
                'uId'   => $user->id
            ]
        ]);

        // Remove the movie from favorite
        if($favorite != null) {
            if($favorite->delete()) {
                $isSuccess = true;
            }
        }

        // Return response
        return [
            'status'    => $isSuccess
        ];
    }
}