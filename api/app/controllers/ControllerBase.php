<?php


namespace BMS\Controllers;


use Phalcon\Config;
use Phalcon\Mvc\Controller;
use stdClass;

/**
 * Class ControllerBase
 *
 * All controllers are expected to extend
 * this class. This class might contain
 * logic that directly or indirectly
 * affects all its derived classes.
 *
 * @package BMS\Controllers
 *
 * @property Config config
 * @property stdClass user
 */
class ControllerBase extends Controller
{
    /**
     * Intercepts a non-POST request. It returns
     * false and makes use of the dispatcher to
     * cause a not-found exception.
     * @return bool
     */
    protected function checkPost()
    {
        if(!$this->request->isPost()) {
            return false;
        }
    }
}