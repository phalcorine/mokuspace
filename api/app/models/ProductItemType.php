<?php

namespace BMS\Models;

class ProductItemType extends ModelBase
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $label;

    /**
     *
     * @var string
     */
    public $description;

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
        $this->setSource("product_item_type");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_item_type';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductItemType[]|ProductItemType|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductItemType|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
