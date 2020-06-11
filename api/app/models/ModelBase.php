<?php


namespace BMS\Models;

use Phalcon\Mvc\Model;
use BMS\Models\Traits\Timestampable;

class ModelBase extends Model
{
    use Timestampable;
}