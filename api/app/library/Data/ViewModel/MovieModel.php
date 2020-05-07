<?php


namespace MovieSpace\Data\ViewModel;


use MovieSpace\Models\Genre;
use MovieSpace\Models\VideoMetadata;

/**
 * Class MovieModel
 *
 * The class basically represents
 * a JSON object (movie)
 *
 * @package MovieSpace\Data\ViewModel
 */
class MovieModel
{
    /** @var integer */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $overview;

    /** @var integer */
    public $runtime;

    /** @var string */
    public $releaseDate;

    /** @var integer */
    public $budget;
    
    /** @var double */
    public $voteAverage;
    
    /** @var string */
    public $posterPath;
    
    /** @var string */
    public $backdropPath;
    
    /** @var string */
    public $status;
    
    /** @var string */
    public $homepage;
    
    /** @var Genre[] */
    public $genres;
    
    /** @var VideoMetadata[] */
    public $videos;
}