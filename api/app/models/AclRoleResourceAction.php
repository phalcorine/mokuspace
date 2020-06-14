<?php

namespace BMS\Models;

class AclRoleResourceAction extends ModelBase
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
    public $resourceId;

    /**
     *
     * @var integer
     */
    public $actionId;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("zephir_bms_db");
        $this->setSource("acl_role_resource_action");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'acl_role_resource_action';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AclRoleResourceAction[]|AclRoleResourceAction|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AclRoleResourceAction|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
