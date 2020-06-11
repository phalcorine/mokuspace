<?php


namespace BMS\Tasks;


use BMS\ApiClient;
use BMS\Data\MovieHelper;
use Phalcon\Config;
use Phalcon\Db\Column;
use Phalcon\Db\Index;

class ScriptTask extends TaskBase
{
    public function initAction()
    {
        $this->createTables();
        $this->fetchMovies();
    }
    /**
     * This cli task creates the required
     * table structures for the application.
     * It supports both MySql and SQLite...
     */
    public function createTables()
    {
        $this->_createTableMovie();
        $this->_createTableGenre();
        $this->_createTableMovieGenre();
        $this->_createTableUserMovieFavorite();
        $this->_createTableVideMetadata();
        $this->_createTableAppUser();
    }

    /**
     * This cli task fetches the movies
     * from the Wootlab's public API and
     * stores the data into the database
     */
    public function fetchMovies()
    {
        /** @var Config $config */
        $config = $this->di->get('config');

        $apiUrl = $config->path('api.url');
        $moviesRoute = $config->path('api.moviesRoute');

        $api = new ApiClient($apiUrl);

        $content = $api->get($moviesRoute);

        $movies = MovieHelper::getMovieDataFromJSON($content);

        foreach ($movies as $movie) {
            MovieHelper::saveViewModelToDB($movie);
        }
    }

    private function _createTableMovie()
    {
        $tableName = 'movie';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'title',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 64,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'overview',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 256,
                        'after' => 'title'
                    ]
                ),
                new Column(
                    'runtime',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'overview'
                    ]
                ),
                new Column(
                    'releaseDate',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 16,
                        'after' => 'runtime'
                    ]
                ),
                new Column(
                    'budget',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'releaseDate'
                    ]
                ),
                new Column(
                    'voteAverage',
                    [
                        'type' => Column::TYPE_DOUBLE,
                        'default' => "0",
                        'notNull' => true,
                        'after' => 'budget'
                    ]
                ),
                new Column(
                    'backdropPath',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'voteAverage'
                    ]
                ),
                new Column(
                    'posterPath',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'backdropPath'
                    ]
                ),
                new Column(
                    'status',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'posterPath'
                    ]
                ),
                new Column(
                    'homepageUrl',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 128,
                        'after' => 'status'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '21',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

    private function _createTableGenre()
    {
        $tableName = 'genre';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'name',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'id'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '13',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

    private function _createTableMovieGenre()
    {
        $tableName = 'movie_genre';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'genreId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'movieId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'genreId'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '60',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

    private function _createTableUserMovieFavorite()
    {
        $tableName = 'user_movie_favorite';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'userId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'movieId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'userId'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '3',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

    private function _createTableVideMetadata()
    {
        $tableName = 'video_metadata';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'movieId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'trailerId',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'after' => 'movieId'
                    ]
                ),
                new Column(
                    'name',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 64,
                        'after' => 'trailerId'
                    ]
                ),
                new Column(
                    'type',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'name'
                    ]
                ),
                new Column(
                    'site',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'type'
                    ]
                ),
                new Column(
                    'videoKey',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'site'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

    private function _createTableAppUser()
    {
        $tableName = 'app_user';

        if($this->db->tableExists($tableName)) {
            return;
        }

        $this->db->createTable($tableName, null, [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
                new Column(
                    'userToken',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 16,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'firstName',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'userToken'
                    ]
                ),
                new Column(
                    'lastName',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 32,
                        'after' => 'firstName'
                    ]
                ),
                new Column(
                    'email',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 128,
                        'after' => 'lastName'
                    ]
                ),
                new Column(
                    'password',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 256,
                        'after' => 'email'
                    ]
                )
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '7',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ],
        ]);
    }

}