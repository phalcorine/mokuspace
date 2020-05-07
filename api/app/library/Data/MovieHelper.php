<?php


namespace MovieSpace\Data;


use MovieSpace\Data\ViewModel\MovieModel;
use MovieSpace\Models\Genre;
use MovieSpace\Models\Movie;
use MovieSpace\Models\MovieGenre;
use MovieSpace\Models\VideoMetadata;

/**
 * Class MovieHelper
 *
 * A helper class for the
 * Movie JSON data
 *
 * @package MovieSpace\Data
 */
class MovieHelper
{
    /**
     * Fetches movie data from a JSON Object
     * @param $jsonData
     * @return mixed
     */
    public static function getMovieDataFromJSON($jsonData)
    {
        $phpData = json_decode($jsonData, false);

        foreach ($phpData as $movie) {
            $movies[] = self::convertObjectToViewModel($movie);
        }

        return $movies;
    }

    /**
     * @param string $jsonArray
     * @return MovieModel[]
     */
    public function transformJSONArrayToModel(string $jsonArray)
    {
        $data = json_decode($jsonArray);
        $payload = [];

        foreach ($data as $movie) {
            $payload[] = self::convertObjectToViewModel($movie);
        }

        return $payload;
    }

    /**
     * Convert a PHP Object (JSON Movie) to an
     * associative array
     * @param \stdClass $data
     * @return array
     */
    public static function convertObjectToAssocArray(\stdClass $data)
    {
        $dataArray = [];

        // Set primitives
        $dataArray["id"] = $data->id;
        $dataArray["title"] = $data->title;
        $dataArray["overview"] = $data->overview;
        $dataArray["runtime"] = $data->runtime;
        $dataArray["releaseDate"] = self::_convertArrayToString($data->releaseDate, ' ');
        $dataArray["budget"] = $data->budget;
        $dataArray["voteAverage"] = $data->voteAverage;
        $dataArray["posterPath"] = $data->posterPath;
        $dataArray["backdropPath"] = $data->backdropPath;
        $dataArray["status"] = $data->status;
        $dataArray["homepage"] = $data->homepage;

        // Set arrays
        $dataArray["genres"] = $data->genres ?? [];
        $dataArray["videos"] = $data->videos ?? [];

        return $dataArray;
    }

    /**
     * Convert a PHP Object (JSON Movie) to a
     * MovieModel object.
     * @param \stdClass $data
     * @return MovieModel
     */
    public static function convertObjectToViewModel(\stdClass $data)
    {
        $viewModel = new MovieModel();

        // Set primitives
        $viewModel->id = $data->id;
        $viewModel->title = $data->title;
        $viewModel->overview = $data->overview;
        $viewModel->runtime = $data->runtime;
        $viewModel->releaseDate = self::_convertArrayToString($data->releaseDate, '/');
        $viewModel->budget = $data->budget;
        $viewModel->voteAverage = $data->voteAverage;
        $viewModel->posterPath = $data->posterPath;
        $viewModel->backdropPath = $data->backdropPath;
        $viewModel->status = $data->status;
        $viewModel->homepage = $data->homepage;

        // Set arrays
        $viewModel->genres = $data->genres ?? [];
        $viewModel->videos = $data->videos ?? [];

        return $viewModel;
    }

    /**
     * Convert a Movie model object to a
     * MovieModel object
     *
     * @param Movie $movie
     * @return MovieModel
     */
    public static function convertModelToViewModel(Movie $movie)
    {
        $viewModel = new MovieModel();

        // Set primitives
        $viewModel->id = $movie->id;
        $viewModel->title = $movie->title;
        $viewModel->overview = $movie->overview;
        $viewModel->runtime = $movie->runtime;
        $viewModel->releaseDate = $movie->releaseDate;
        $viewModel->budget = $movie->budget;
        $viewModel->voteAverage = $movie->voteAverage;
        $viewModel->posterPath = $movie->posterPath;
        $viewModel->backdropPath = $movie->backdropPath;
        $viewModel->status = $movie->status;
        $viewModel->homepage = $movie->homepageUrl;

        // Set arrays
        $viewModel->genres = $movie->getGenres()->toArray();
        $viewModel->videos = $movie->getVideos()->toArray();

        return $viewModel;
    }

    /**
     * Saves a MovieModel object to the database
     * @param MovieModel $model
     */
    public static function saveViewModelToDB(MovieModel $model)
    {
        // Fetch all genres (to prevent creating duplicates)
        $dbGenres = Genre::find();

        // Save the movie
        $movie = new Movie();
        $movie->title = $model->title;
        $movie->overview = $model->overview;
        $movie->runtime = $model->runtime;
        $movie->releaseDate = $model->releaseDate;
        $movie->budget = $model->budget;
        $movie->voteAverage = $model->voteAverage;
        $movie->posterPath = $model->posterPath;
        $movie->backdropPath = $model->backdropPath;
        $movie->status = $model->status;
        $movie->homepageUrl = $model->homepage;
        $movie->create();

        /**
         * Save the genre for the movies. This will
         * also prevent duplicates if a genre already
         * exist with the same name in the database
         */
        foreach ($model->genres as $modelGenre) {
            $genre = null;
            foreach ($dbGenres as $dbGenre) {
                if($modelGenre->name == $dbGenre->name) {
                    $genre = $dbGenre;
                }
            }

            if($genre == null) {
                $newGenre = new Genre();
                $newGenre->name = $modelGenre->name;
                $newGenre->create();
                $genre = $newGenre;
            }

            $genreLink = new MovieGenre();
            $genreLink->movieId = $movie->id;
            $genreLink->genreId = $genre->id;
            $genreLink->create();
        }

        // Save the video metadata
        foreach ($model->videos as $video) {
            $videoData = new VideoMetadata();
            $videoData->movieId = $movie->id;
            $videoData->name = $video->name;
            $videoData->videoKey = $video->key;
            $videoData->site = $video->site;
            $videoData->type = $video->type;
            $videoData->trailerId = $video->id;
            $videoData->create();
        }
    }

    /**
     * @param array $data
     * @param string $delimiter
     * @return string
     */
    private static function _convertArrayToString(array $data, string $delimiter = '')
    {
        $payload = '';

        foreach ($data as $datum) {
            $payload .= $datum . $delimiter;
        }

        return rtrim($payload, $delimiter);
    }
}