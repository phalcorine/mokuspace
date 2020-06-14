<?php

namespace BMS\Models;

class AppUserLogin extends ModelBase
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
    public $loginUsername;

    /**
     *
     * @var string
     */
    public $loginPassword;

    /**
     *
     * @var integer
     */
    public $mustChangePassword;

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
        $this->setSource("app_user_login");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'app_user_login';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUserLogin[]|AppUserLogin|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppUserLogin|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
