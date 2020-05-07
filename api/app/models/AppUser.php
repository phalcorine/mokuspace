<?php

namespace MovieSpace\Models;

use MovieSpace\Util\TokenGenerator;
use Phalcon\Validation;

/**
 * Class AppUser
 * @package MovieSpace\Models
 */
class AppUser extends ModelBase
{

    const ALIAS_FAV_MOVIES = 'FavoriteMovies';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $userToken;

    /**
     *
     * @var string
     */
    public $firstName;

    /**
     *
     * @var string
     */
    public $lastName;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("movie_space");
        $this->setSource("app_user");
        $this->hasManyToMany(
            'id',
            UserMovieFavorite::class,
            'userId',
            'movieId',
            Movie::class,
            'id', [
                'alias'     => self::ALIAS_FAV_MOVIES
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
        return 'app_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUser[]|AppUser|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUser|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function beforeValidationOnCreate()
    {
        // Run parent code (timestamp)
        parent::beforeValidationOnCreate();

        $this->userToken = TokenGenerator::getTimedToken('USR');
    }

    public function validation()
    {
        // Create a validator
        $validator = new Validation();

        // Email uniqueness. We wont want anyone
        // creating double accounts with the same
        // email. Or should we?
        $validator->add('email', new Validation\Validator\Uniqueness([
            'message'   => 'A user with this email already exists'
        ]));

        return $this->validate($validator);
    }

    /**
     * Custom functions
     */

    /**
     * Returns a list of favorite movies
     *
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public function getFavoriteMovies()
    {
        return $this->getRelated(self::ALIAS_FAV_MOVIES);
    }

}
