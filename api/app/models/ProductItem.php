<?php

namespace BMS\Models;

class ProductItem extends ModelBase
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
    public $categoryId;

    /**
     *
     * @var integer
     */
    public $itemId;

    /**
     *
     * @var string
     */
    public $sku;

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
    public $quantityOnHand;

    /**
     *
     * @var integer
     */
    public $reorderLevel;

    /**
     *
     * @var string
     */
    public $sellingPrice;

    /**
     *
     * @var string
     */
    public $minimumSellingPrice;

    /**
     *
     * @var integer
     */
    public $canSell;

    /**
     *
     * @var integer
     */
    public $canPurchase;

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
        $this->setSource("product_item");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_item';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductItem[]|ProductItem|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductItem|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
