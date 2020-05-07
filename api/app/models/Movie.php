<?php

namespace MovieSpace\Models;

class Movie extends ModelBase
{

    const ALIAS_FAV_USERS = 'FavoriteUsers';
    const ALIAS_GENRES = 'Genres';
    const ALIAS_VIDEOS = 'Videos';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $overview;

    /**
     *
     * @var integer
     */
    public $runtime;

    /**
     *
     * @var string
     */
    public $releaseDate;

    /**
     *
     * @var integer
     */
    public $budget;

    /**
     *
     * @var string
     */
    public $voteAverage;

    /**
     *
     * @var string
     */
    public $backdropPath;

    /**
     *
     * @var string
     */
    public $posterPath;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var string
     */
    public $homepageUrl;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("movie_space");
        $this->setSource("movie");

        // Link Many-to-Many relationship between
        // Movies and Users
        $this->hasManyToMany(
            'id',
            UserMovieFavorite::class,
            'movieId',
            'userId',
            AppUser::class,
            'id', [
                'alias'     => self::ALIAS_FAV_USERS
            ]
        );

        // Link Many-to-Many relationship between
        // Movie and Genre
        $this->hasManyToMany(
            'id',
            MovieGenre::class,
            'movieId',
            'genreId',
            Genre::class,
            'id', [
                'alias'     => self::ALIAS_GENRES
            ]
        );

        // Link One-to-Many relationship between
        // Movie and VideoMetadata
        $this->hasMany(
            'id',
            VideoMetadata::class,
            'movieId', [
                'alias'     => self::ALIAS_VIDEOS
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'movie';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movie[]|Movie|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Movie|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Custom functions
     */

    /**
     * Returns the genres for this movie
     *
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function getGenres()
    {
        return $this->getRelated(self::ALIAS_GENRES);
    }

    /**
     * Returns the videos for this movie
     *
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function getVideos()
    {
        return $this->getRelated(self::ALIAS_VIDEOS);
    }

}
