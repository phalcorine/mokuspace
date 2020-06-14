<?php

namespace BMS\Models;

class Warehouse extends ModelBase
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
    public $managerId;

    /**
     *
     * @var integer
     */
    public $label;

    /**
     *
     * @var integer
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $streetAddress;

    /**
     *
     * @var integer
     */
    public $city;

    /**
     *
     * @var integer
     */
    public $state;

    /**
     *
     * @var integer
     */
    public $isOpen;

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
        $this->setSource("warehouse");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'warehouse';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Warehouse[]|Warehouse|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Warehouse|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
