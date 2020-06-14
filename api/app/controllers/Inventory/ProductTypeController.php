<?php


namespace BMS\Controllers\Inventory;


use BMS\Helper\Str;
use BMS\Models\ProductItemType;
use BMS\Plugins\SecurityPlugin;

class ProductTypeController extends ControllerBase
{
    /**
     * Fetches all product types
     *
     * @api {get} /inventory/productTypes Fetch a list of all product types
     * @apiName GetProductTypes
     * @apiGroup Inventory / Product Types
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productTypes
     *
     * @apiSuccess {Array} payload A JSON array of product types
     * @apiVersion 0.0.1
     */
    public function allAction()
    {
        // Fetch all product types
        $types = ProductItemType::find([
            'order' => 'label ASC'
        ]);

        // Return response
        return $types;
    }

    /**
     * Fetches a single product type by ID
     *
     * @api {get} /inventory/productTypes/:id Fetch a single product type by ID
     * @apiParam {Integer} id The ID of the product type to be fetched
     * @apiName GetProductType
     * @apiGroup Inventory / Product Types
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productTypes/3
     *
     * @apiSuccess {Object} payload The product type object with the specified ID
     * @apiVersion 0.0.1
     */
    public function oneAction()
    {
        // Get the Type ID
        $typeId = $this->dispatcher->getParam('id');

        // Fetch product type by ID
        $type = ProductItemType::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $typeId
            ]
        ]);

        // Return error response if product types does not exist
        if($type == null) {
            throw new \Exception(
                "A product type with the ID: {$typeId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        return $type;
    }

    /**
     * Creates a new product type
     *
     * @api {post} /inventory/productTypes Create a product type
     * @apiName CreateProductType
     * @apiGroup Inventory / Product Types
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "label": "Bakery",
     *          "description": "Bakery stuff"
     *      }' http://api.zephirbms.code/inventory/productTypes
     *
     * @apiSuccess {Object} payload The newly created product type object
     * @apiVersion 0.0.1
     */
    public function createAction()
    {
        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Create a product type object
        $type = new ProductItemType();
        $type->assign($data);

        // Attempt to save the record
        $success = $type->create();

        // Return error response if an error occurred
        if($success === false) {
            // If not successful
            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($type->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response...
        return $type;
    }

    /**
     * Updates an existing product type
     *
     * @api {put} /inventory/productTypes/:id Update a product type
     * @apiParam {Integer} id The ID of the product type to be updated
     * @apiName UpdateProductType
     * @apiGroup Inventory / Product Types
     * @apiExample Example of use:
     *      curl -i -X PUT -d '{
     *          "label": "Bakery",
     *          "description": "Bakery and related stuff..."
     *      }' http://api.zephirbms.code/inventory/productTypes/3
     * @apiSuccess {Object} payload The updated product type object
     * @apiVersion 0.0.1
     */
    public function updateAction()
    {
        // Retrieve Product Type ID
        $typeId = $this->dispatcher->getParam('id');

        // Fetch product type by ID
        $type = ProductItemType::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $typeId
            ]
        ]);

        // Return error response if product type does not exist
        if($type == null) {
            throw new \Exception(
                "A product type with the specified ID {$typeId} was not found...",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Update the product type object
        $type->assign($data);

        // Attempt to save the record
        $success = $type->update();

        // If not successful
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($type->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $type;
    }

    /**
     * Deletes a product type
     *
     * @api {delete} /inventory/productTypes/:id Delete a product type
     * @apiParam {Integer} id The ID of the product type to be deleted
     * @apiName DeleteProductType
     * @apiGroup Inventory / Product Types
     * @apiExample Example of use:
     *      curl -i -X DELETE http://api.zephirbms.code/inventory/productTypes/3
     *
     * @apiSuccess {Object} payload The deleted product type object
     * @apiVersion 0.0.1
     */
    public function deleteAction()
    {
        // Retrieve Product Type ID
        $typeId = $this->dispatcher->getParam('id');

        // Fetch product type by ID
        $type = ProductItemType::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $typeId
            ]
        ]);

        // Return error response if product type does not exist
        if($type == null) {
            throw new \Exception(
                "A product type with the specified ID {$typeId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Attempt to delete product type
        $success = $type->delete();

        // If delete fails
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($type->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $type;
    }
}