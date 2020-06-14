<?php


namespace BMS\Controllers\Inventory;


use BMS\Helper\Str;
use BMS\Plugins\SecurityPlugin;

class ProductRecipeController extends ControllerBase
{
    /**
     * Fetches a list of product recipes
     *
     * @api {get} /inventory/productRecipes Fetch a list of product recipes
     * @apiName GetProductRecipes
     * @apiGroup Inventory / Product Recipes
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productRecipes
     *
     * @apiSuccess {Array} payload A JSON array of product recipes
     */
    public function allAction()
    {
        $recipes = ProductRecipe::find([
            'order'    => 'label ASC'
        ]);

        return $recipes;
    }

    /**
     * Fetches a single product recipe by ID
     *
     * @api {get} /inventory/productRecipes/:id Fetch a single product recipe by ID
     * @apiParam {Integer} id The ID of the product recipe to be fetched
     * @apiName GetProductRecipe
     * @apiGroup Inventory / Product Recipes
     * @apiExample Example of use:
     *      curl -i -X GET http://api.zephirbms.code/inventory/productRecipes/3
     *
     * @apiSuccess {Object} payload The product recipe with the specified ID
     * @apiVersion 0.0.1
     */
    public function oneAction()
    {
        // Get the Recipe ID
        $recipeId = $this->dispatcher->getParam('id');

        // Fetch recipe by ID
        $recipe = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $recipeId
            ]
        ]);

        // Return error response if product category does not exist
        if($recipe == null) {
            throw new \Exception(
                "A product recipe with the ID: {$recipeId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        return $recipe;
    }

    /**
     * Creates a new product recipe
     *
     * @api {post} /inventory/productRecipes Create a product recipe
     * @apiName CreateProductRecipe
     * @apiGroup Inventory / Product Recipes
     * @apiExample Example of use:
     *      curl -i -X POST -d '{
     *          "label": "Recipe for 212 Bread",
     *          "description": "The magic formula..."
     *      }' http://api.zephirbms.code/inventory/productRecipes
     *
     * @apiSuccess {Object} payload The newly created product recipe object
     * @apiVersion 0.0.1
     */
    public function createAction()
    {
        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Create a product recipe object
        $recipe = new ProductItemCategory();
        $recipe->assign($data);

        // Attempt to save the record
        $success = $recipe->create();

        // Return error response if an error occurred
        if($success === false) {
            // If not successful
            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($recipe->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response...
        return $recipe;
    }

    /**
     * Updates an existing product recipe
     *
     * @api {put} /inventory/productRecipe/:id Update a product category
     * @apiParam {Integer} id The ID of the product recipe to be updated
     * @apiName UpdateProductRecipe
     * @apiGroup Inventory / Product Recipes
     * @apiExample Example of use:
     *      curl -i -X PUT -d '{
     *          "label": "Recipe for 212 Bread",
     *          "description": "The magic formula (I think)..."
     *      }' http://api.zephirbms.code/inventory/productRecipes/3
     * @apiSuccess {Object} payload The updated product recipe object
     * @apiVersion 0.0.1
     */
    public function updateAction()
    {
        // Retrieve Category ID
        $recipeId = $this->dispatcher->getParam('id');

        // Fetch product category by ID
        $recipe = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $recipeId
            ]
        ]);

        // Return error response if product recipe does not exist
        if($recipe == null) {
            throw new \Exception(
                "A product recipe with the specified ID {$recipeId} was not found...",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Retrieve request data
        $data = $this->request->getJsonRawBody(true);

        // Update the product recipe object
        // @TODO: Inventory / Recipe - Update recipe
        $recipe->assign($data);

        // Attempt to save the record
        $success = $recipe->update();

        // If not successful
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($recipe->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $recipe;
    }

    /**
     * Deletes a product recipe
     *
     * @api {delete} /inventory/productRecipes/:id Delete a product recipe
     * @apiParam {Integer} id The ID of the product recipe to be deleted
     * @apiName DeleteProductRecipe
     * @apiGroup Inventory / Product Recipes
     * @apiExample Example of use:
     *      curl -i -X DELETE http://api.zephirbms.code/inventory/productRecipes/3
     *
     * @apiSuccess {Object} payload The deleted product recipe object
     * @apiVersion 0.0.1
     */
    public function deleteAction()
    {
        // Retrieve Recipe ID
        $recipeId = $this->dispatcher->getParam('id');

        // Fetch recipe by ID
        $recipe = ProductItemCategory::findFirst([
            'conditions'    => 'id = :id:',
            'bind'  => [
                'id'    => $recipeId
            ]
        ]);

        // Return error response if product recipe does not exist
        if($recipe == null) {
            throw new \Exception(
                "A product recipe with the specified ID {$recipeId} was not found",
                SecurityPlugin::CODE_ERROR_NOT_FOUND
            );
        }

        // Attempt to delete product recipe
        $success = $recipe->delete();

        // If delete fails
        if($success === false) {

            $errorMessage = 'One or more errors occurred.';

            // Fetch error messages
            $errorMessage .= Str::getDotSeparatedStringFromIterable($recipe->getMessages());

            // Raise exception
            throw new \Exception(
                $errorMessage, SecurityPlugin::CODE_ERROR_SERVER
            );
        }

        // Return response
        return $recipe;
    }
}