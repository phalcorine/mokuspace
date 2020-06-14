<?php


namespace BMS\Routes;


class InventoryRoutes extends RouterBase
{
    public function initialize()
    {
        // Configure the router
        $this->setPaths([
            'namespace'     => 'BMS\Controllers\Inventory'
        ]);

        // Set prefix
        $this->setPrefix('/inventory');

        // Add routes

        // Product Categories
        $this->productCategoryRoutes();

        // Product Items
        $this->productItemRoutes();

        // Product Types
        $this->productTypeRoutes();
    }

    public function productCategoryRoutes()
    {
        // GetProductCategories
        // @TODO: Add filters and sort parameters...
        $this->addGet('/productCategories', [
            'controller'    => 'productCategory',
            'action'        => 'all'
        ]);

        // GetProductCategory
        $this->addGet('/productCategories/{id}', [
            'controller'    => 'productCategory',
            'action'        => 'one'
        ]);

        // CreateProductCategory
        $this->addPost('/productCategories', [
            'controller'    => 'productCategory',
            'action'        => 'create'
        ]);

        // UpdateProductCategory
        $this->addPut('/productCategories/{id}', [
            'controller'    => 'productCategory',
            'action'        => 'update'
        ]);

        // DeleteProductCategory
        $this->addDelete('/productCategories/{id}', [
            'controller'    => 'productCategory',
            'action'        => 'delete'
        ]);
    }

    public function productItemRoutes()
    {
        // GetProductItems
        $this->addGet('/products', [
            'controller'    => 'productItem',
            'action'        => 'all'
        ]);

        // GetProductItem
        $this->addGet('/products/{id}', [
            'controller'    => 'productItem',
            'action'        => 'one'
        ]);

        // CreateProductItem
        $this->addPost('/products', [
            'controller'    => 'productItem',
            'action'        => 'create'
        ]);

        // UpdateProductItem
        $this->addPut('/products/{id}', [
            'controller'    => 'productItem',
            'action'        => 'update'
        ]);

        // DeleteProductItem
        $this->addDelete('/products/{id}', [
            'controller'    => 'productItem',
            'action'        => 'delete'
        ]);
    }

    public function productTypeRoutes()
    {
        // GetProductTypes
        $this->addGet('/productTypes', [
            'controller'    => 'productType',
            'action'        => 'all'
        ]);

        // GetProductType
        $this->addGet('/productTypes/{id}', [
            'controller'    => 'productType',
            'action'        => 'one'
        ]);

        // CreateProductType
        $this->addPost('/productTypes', [
            'controller'    => 'productType',
            'action'        => 'create'
        ]);

        // UpdateProductType
        $this->addPut('/productTypes/{id}', [
            'controller'    => 'productType',
            'action'        => 'update'
        ]);

        // DeleteProductType
        $this->addDelete('/productTypes/{id}', [
            'controller'    => 'productType',
            'action'        => 'delete'
        ]);
    }
}