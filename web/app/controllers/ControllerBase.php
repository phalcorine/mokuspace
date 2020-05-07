<?php


namespace MovieSpace\Controllers;


use MovieSpace\ApiClient;
use Phalcon\Config;
use Phalcon\Logger\Adapter\File as Logger;
use Phalcon\Mvc\Controller;
use Phalcon\Tag;

/**
 * Class ControllerBase
 *
 * All controllers are expected to extend
 * this class. This class might contain
 * logic that directly or indirectly
 * affects all its derived classes.
 *
 * @package MovieSpace\Controllers
 *
 * @property ApiClient api
 * @property Config config
 * @property Logger logger
 */
class ControllerBase extends Controller
{
    /**
     * This method is called immediately after an instance
     * of any derived class is created. It loads a
     * collection of assets/tags items for use by the view
     */
    public function onConstruct()
    {
        // Add our CSS imports
        $headCollections = $this->assets->collection('head');
        $headCollections->addCss('libraries/bootstrap-4.3.1-dist/css/bootstrap.min.css');
        $headCollections->addCss('libraries/fontawesome-free-5.11.2-web/css/all.css');
        $headCollections->addCss('css/moviespace.css');

        // Add our Scripts
        $footerCollections = $this->assets->collection('footer');
        $footerCollections->addJs('libraries/jquery-3.4.1/jquery-3.4.1.min.js');
        $footerCollections->addJs('libraries/bootstrap-4.3.1-dist/js/bootstrap.min.js');

        // Set our HTML Head-Tag info
        Tag::setTitle('MovieSpace');
        Tag::setDocType(Tag::HTML5);
    }
}