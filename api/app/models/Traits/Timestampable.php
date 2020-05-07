<?php


namespace MovieSpace\Models\Traits;

/**
 * Trait Timestampable
 * This allows us to automatically include
 * timestamp for both createdAt and
 * updatedAt fields in our models
 *
 * @package MovieSpace\Models\Traits
 * @property int createdAt
 * @property int updatedAt
 */
trait Timestampable
{
    public function beforeValidationOnCreate()
    {
        $this->createdAt = time();
    }

    public function beforeUpdate()
    {
        $this->updatedAt = time();
    }
}