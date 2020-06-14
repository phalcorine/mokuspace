<?php

namespace BMS\Models;

class BlobData extends ModelBase
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
    public $blob_key;

    /**
     *
     * @var string
     */
    public $data;

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
        $this->setSource("blob_data");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'blob_data';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BlobData[]|BlobData|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BlobData|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
