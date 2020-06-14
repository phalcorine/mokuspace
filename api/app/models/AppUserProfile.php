<?php

namespace BMS\Models;

class AppUserProfile extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $userId;

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
    public $contactAddress;

    /**
     *
     * @var string
     */
    public $contactEmail;

    /**
     *
     * @var string
     */
    public $contactPhone;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     *
     * @var integer
     */
    public $updatedAt;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("zephir_bms_db");
        $this->setSource("app_user_profile");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'app_user_profile';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUserProfile[]|AppUserProfile|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUserProfile|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
