<?php


namespace BMS\Controllers\Inventory;


use BMS\Helper\Str;
use BMS\Models\ProductItemCategory;
use BMS\Plugins\SecurityPlugin;

class ProductCategoryController extends ControllerBase
{
    /**
     * Fetches all product categories
     *
     * @api {get} /inventory/productCategories Fetch a list of all product categories
     * @apiName GetProductCategories
     * @apiGroup Inventory / Product Categories
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productCategories
     *
     * @apiSuccess {Array} payload A JSON array of product categories
     * @apiVersion 0.0.1
     */
    public function allAction()
    {
        // Fetch all product categories
        $categories = ProductItemCategory::find([
            'order' => 'label ASC'
        ]);

        // Return response
        return $categories;
    }

    /**
     * Fetches a single category by ID
     *
     * @api {get} /inventory/productCategories/:id Fetch a single product category by ID
     * @apiParam {Integer} id The ID of the product category to be fetched
     * @apiName GetProductCategory
     * @apiGroup Inventory / Product Categories
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productCategories/3
     *
     * @apiSuccess {Object} payload The product category object with the specified ID
     * @apiVersion 0.0.1
     */
    public function oneAction()
    {
        // Get the Category ID
        $categoryId = $this->dispatcher->getParam('id');

        // Fetch category by ID
        $category = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $categoryId
            ]
        ]);

        // Return error response if product category does not exist
        if($category == null) {
            throw new \Exception(
                "A product category with the ID: {$categoryId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        return $category;
    }

    /**
     * Creates a new product category
     *
     * @api {post} /inventory/productCategories Create a product category
     * @apiName CreateProductCategory
     * @apiGroup Inventory / Product Categories
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "label": "Bakery",
     *          "description": "Bakery stuff"
     *      }' http://api.zephirbms.code/inventory/productCategories
     *
     * @apiSuccess {Object} payload The newly created product category object
     * @apiVersion 0.0.1
     */
    public function createAction()
    {
        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Create a product category object
        $category = new ProductItemCategory();
        $category->assign($data);

        // Attempt to save the record
        $success = $category->create();

        // Return error response if an error occurred
        if($success === false) {
            // If not successful
            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($category->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response...
        return $category;
    }

    /**
     * Updates an existing product category
     *
     * @api {put} /inventory/productCategories/:id Update a product category
     * @apiParam {Integer} id The ID of the product category to be updated
     * @apiName UpdateProductCategory
     * @apiGroup Inventory / Product Categories
     * @apiExample Example of use:
     *      curl -i -X PUT -d '{
     *          "label": "Bakery",
     *          "description": "Bakery and related stuff..."
     *      }' http://api.zephirbms.code/inventory/productCategories/3
     * @apiSuccess {Object} payload The u[dated product category object
     * @apiVersion 0.0.1
     */
    public function updateAction()
    {
        // Retrieve Category ID
        $categoryId = $this->dispatcher->getParam('id');

        // Fetch product category by ID
        $category = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $categoryId
            ]
        ]);

        // Return error response if product does not exist
        if($category == null) {
            throw new \Exception(
                "A product category with the specified ID {$categoryId} was not found...",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Update the product category object
        $category->assign($data);

        // Attempt to save the record
        $success = $category->update();

        // If not successful
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($category->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $category;
    }

    /**
     * Deletes a product category
     *
     * @api {delete} /inventory/productCategories/:id Delete a product category
     * @apiParam {Integer} id The ID of the product item to be deleted
     * @apiName DeleteProductCategory
     * @apiGroup Inventory / Product Categories
     * @apiExample Example of use:
     *      curl -i -X DELETE http://api.zephirbms.code/inventory/productCategories/3
     *
     * @apiSuccess {Object} payload The deleted product category object
     * @apiVersion 0.0.1
     */
    public function deleteAction()
    {
        // Retrieve Category ID
        $categoryId = $this->dispatcher->getParam('id');

        // Fetch category by ID
        $category = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $categoryId
            ]
        ]);

        // Return error response if product category does not exist
        if($category == null) {
            throw new \Exception(
                "A product category with the specified ID {$categoryId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Attempt to delete product category
        $success = $category->delete();

        // If delete fails
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($category->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $category;
    }
}