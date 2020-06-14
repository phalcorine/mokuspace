<?php


namespace BMS\Controllers\Inventory;


use BMS\Helper\Str;
use BMS\Models\ProductItem;
use BMS\Plugins\SecurityPlugin;

class ProductItemController extends ControllerBase
{
    /**
     * Fetches all the product items available.
     *
     * @api {get} /inventory/products Fetch a list of all product items
     * @apiName GetProductItems
     * @apiGroup Inventory / Product Items
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/products/all
     *
     * @apiSuccess {Array} payload A JSON array of product items
     *
     * @apiVersion 0.0.1
     */
    public function allAction()
    {
        // Fetch all the products
        $products = ProductItem::find([
            'order'     => 'label ASC'
        ]);

        // Return the response
        return $products;
    }

    /**
     * Fetches a single product item by ID
     *
     * @api {get} /inventory/products/:id Fetch a single product item by ID
     * @apiParam {Integer} id The Id of the product to be fetched
     * @apiName GetProductItem
     * @apiGroup Inventory / Product Items
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbbms.code/inventory/products/3
     *
     * @apiSuccess {Object} payload The product item with the specified ID
     */
    public function oneAction()
    {
        // Get the Product ID
        $productId = $this->dispatcher->getParam('id');

        // Fetch product by ID
        $product = ProductItem::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $productId
            ]
        ]);

        // Return error response if product does not exist
        if($product == null) {
            throw new \Exception(
                "A product item with the ID: {$productId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        return $product;
    }

    /**
     * @api {post} /inventory/products Create a product item
     * @apiName CreateProductItem
     * @apiGroup Inventory / Product Items
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "categoryId": 2,
     *          "itemTypeId": 1,
     *          "sku": "212PRODAKX",
     *          "label": "212 Nutrient Bread",
     *          "description": "Delicious bread (with nutrients of course...",
     *          "quantityOnHand": 23,
     *          "reorderLevel": 20,
     *          "sellingPrice": 300,
     *          "minimumSellingPrice": 250,
     *          "canSell": true,
     *          "canPurchase": true
     *      }' http://api.zephirbms.code/inventory/products
     *
     * @apiSuccess {Object} payload The newly created product item object
     * @apiVersion 0.0.1
     */
    public function createAction()
    {
        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Create a product item object
        $product = new ProductItem();
        $product->assign($data);

        // Attempt to save the record
        $success = $product->create();

        // Return error response if an error occurred
        if($success === false) {
            // If not successful
            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($product->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response...
        return $product;
    }

    /**
     * Updates a product item
     *
     * @api {put} /inventory/products/:id Update a product item
     * @apiParam {Integer} id The ID of the product item to be updated
     * @apiName UpdateProductItem
     * @apiGroup Inventory / Product Items
     * @apiExample Example of use:
     *      curl -i -X PUT -d '{
     *          "categoryId": 2,
     *          "itemTypeId": 1,
     *          "sku": "212PRODAKX",
     *          "label": "212 Nutrient Bread",
     *          "description": "Delicious bread (with nutrients of course...",
     *          "quantityOnHand": 23,
     *          "reorderLevel": 20,
     *          "sellingPrice": 300,
     *          "minimumSellingPrice": 250,
     *          "canSell": true,
     *          "canPurchase": true
     *      }' http://api.zephirbms.code/inventory/products/3
     * @apiSuccess {Object} payload The updated product item object
     * @apiVersion 0.0.1
     */
    public function updateAction()
    {
        // Retrieve Product ID
        $productId = $this->dispatcher->getParam('id');

        // Fetch product by ID
        $product = ProductItem::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $productId
            ]
        ]);

        // Return error response if product does not exist
        if($product == null) {
            throw new \Exception(
                "A product item with the specified ID {$productId} was not found...",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Update the product item object
        $product->assign($data);

        // Attempt to save the record
        $success = $product->update();

        // If not successful
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($product->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $product;
    }

    /**
     * Deletes a product
     *
     * @api {delete} /inventory/products/:id Delete a product item
     * @apiParam {Integer} id The ID of the product item to be deleted
     * @apiName DeleteProductItem
     * @apiGroup Inventory / Product Items
     * @apiExample Example of use:
     *      curl -i -X DELETE http://api.zephirbms.code/inventory/products/3
     *
     * @apiSuccess {Object} payload The deleted product item object
     * @apiVersion 0.0.1
     */
    public function deleteAction()
    {
        // Retrieve Product ID
        $productId = $this->dispatcher->getParam('id');

        // Fetch product by ID
        $product = ProductItem::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $productId
            ]
        ]);

        // Return error response if product does not exist
        if($product == null) {
            throw new \Exception(
                "A product item with the specified ID {$productId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Attempt to delete product item
        $success = $product->delete();

        // If delete fails
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($product->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $product;
    }
}