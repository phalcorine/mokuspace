<?php


namespace MovieSpace\Models;


use MovieSpace\Models\Traits\Timestampable;
use Phalcon\Mvc\Model;

class ModelBase extends Model
{
    use Timestampable;
}