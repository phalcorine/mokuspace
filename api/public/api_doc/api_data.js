define({ "api": [
  {
    "type": "get",
    "url": "/health",
    "title": "System Health Status",
    "name": "systemHealth",
    "group": "General",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>returns the system's health status</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/IndexController.php",
    "groupTitle": "General"
  },
  {
    "type": "post",
    "url": "/inventory/productCategories",
    "title": "Create a product category",
    "name": "CreateProductCategory",
    "group": "Inventory_/_Product_Categories",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"label\": \"Bakery\",\n    \"description\": \"Bakery stuff\"\n}' http://api.zephirbms.code/inventory/productCategories",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The newly created product category object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductCategoryController.php",
    "groupTitle": "Inventory_/_Product_Categories"
  },
  {
    "type": "delete",
    "url": "/inventory/productCategories/:id",
    "title": "Delete a product category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product item to be deleted</p>"
          }
        ]
      }
    },
    "name": "DeleteProductCategory",
    "group": "Inventory_/_Product_Categories",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X DELETE http://api.zephirbms.code/inventory/productCategories/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The deleted product category object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductCategoryController.php",
    "groupTitle": "Inventory_/_Product_Categories"
  },
  {
    "type": "get",
    "url": "/inventory/productCategories",
    "title": "Fetch a list of all product categories",
    "name": "GetProductCategories",
    "group": "Inventory_/_Product_Categories",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productCategories",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "payload",
            "description": "<p>A JSON array of product categories</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductCategoryController.php",
    "groupTitle": "Inventory_/_Product_Categories"
  },
  {
    "type": "get",
    "url": "/inventory/productCategories/:id",
    "title": "Fetch a single product category by ID",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product category to be fetched</p>"
          }
        ]
      }
    },
    "name": "GetProductCategory",
    "group": "Inventory_/_Product_Categories",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productCategories/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The product category object with the specified ID</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductCategoryController.php",
    "groupTitle": "Inventory_/_Product_Categories"
  },
  {
    "type": "put",
    "url": "/inventory/productCategories/:id",
    "title": "Update a product category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product category to be updated</p>"
          }
        ]
      }
    },
    "name": "UpdateProductCategory",
    "group": "Inventory_/_Product_Categories",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X PUT -d '{\n    \"label\": \"Bakery\",\n    \"description\": \"Bakery and related stuff...\"\n}' http://api.zephirbms.code/inventory/productCategories/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The u[dated product category object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductCategoryController.php",
    "groupTitle": "Inventory_/_Product_Categories"
  },
  {
    "type": "post",
    "url": "/inventory/products",
    "title": "Create a product item",
    "name": "CreateProductItem",
    "group": "Inventory_/_Product_Items",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"categoryId\": 2,\n    \"itemTypeId\": 1,\n    \"sku\": \"212PRODAKX\",\n    \"label\": \"212 Nutrient Bread\",\n    \"description\": \"Delicious bread (with nutrients of course...\",\n    \"quantityOnHand\": 23,\n    \"reorderLevel\": 20,\n    \"sellingPrice\": 300,\n    \"minimumSellingPrice\": 250,\n    \"canSell\": true,\n    \"canPurchase\": true\n}' http://api.zephirbms.code/inventory/products",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The newly created product item object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductItemController.php",
    "groupTitle": "Inventory_/_Product_Items"
  },
  {
    "type": "delete",
    "url": "/inventory/products/:id",
    "title": "Delete a product item",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product item to be deleted</p>"
          }
        ]
      }
    },
    "name": "DeleteProductItem",
    "group": "Inventory_/_Product_Items",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X DELETE http://api.zephirbms.code/inventory/products/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The deleted product item object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductItemController.php",
    "groupTitle": "Inventory_/_Product_Items"
  },
  {
    "type": "get",
    "url": "/inventory/products/:id",
    "title": "Fetch a single product item by ID",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The Id of the product to be fetched</p>"
          }
        ]
      }
    },
    "name": "GetProductItem",
    "group": "Inventory_/_Product_Items",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbbms.code/inventory/products/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The product item with the specified ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "../../app/controllers/Inventory/ProductItemController.php",
    "groupTitle": "Inventory_/_Product_Items"
  },
  {
    "type": "get",
    "url": "/inventory/products",
    "title": "Fetch a list of all product items",
    "name": "GetProductItems",
    "group": "Inventory_/_Product_Items",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/products/all",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "payload",
            "description": "<p>A JSON array of product items</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductItemController.php",
    "groupTitle": "Inventory_/_Product_Items"
  },
  {
    "type": "put",
    "url": "/inventory/products/:id",
    "title": "Update a product item",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product item to be updated</p>"
          }
        ]
      }
    },
    "name": "UpdateProductItem",
    "group": "Inventory_/_Product_Items",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X PUT -d '{\n    \"categoryId\": 2,\n    \"itemTypeId\": 1,\n    \"sku\": \"212PRODAKX\",\n    \"label\": \"212 Nutrient Bread\",\n    \"description\": \"Delicious bread (with nutrients of course...\",\n    \"quantityOnHand\": 23,\n    \"reorderLevel\": 20,\n    \"sellingPrice\": 300,\n    \"minimumSellingPrice\": 250,\n    \"canSell\": true,\n    \"canPurchase\": true\n}' http://api.zephirbms.code/inventory/products/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The updated product item object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductItemController.php",
    "groupTitle": "Inventory_/_Product_Items"
  },
  {
    "type": "post",
    "url": "/inventory/productRecipes",
    "title": "Create a product recipe",
    "name": "CreateProductRecipe",
    "group": "Inventory_/_Product_Recipes",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"label\": \"Recipe for 212 Bread\",\n    \"description\": \"The magic formula...\"\n}' http://api.zephirbms.code/inventory/productRecipes",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The newly created product recipe object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductRecipeController.php",
    "groupTitle": "Inventory_/_Product_Recipes"
  },
  {
    "type": "delete",
    "url": "/inventory/productRecipes/:id",
    "title": "Delete a product recipe",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product recipe to be deleted</p>"
          }
        ]
      }
    },
    "name": "DeleteProductRecipe",
    "group": "Inventory_/_Product_Recipes",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X DELETE http://api.zephirbms.code/inventory/productRecipes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The deleted product recipe object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductRecipeController.php",
    "groupTitle": "Inventory_/_Product_Recipes"
  },
  {
    "type": "get",
    "url": "/inventory/productRecipes/:id",
    "title": "Fetch a single product recipe by ID",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product recipe to be fetched</p>"
          }
        ]
      }
    },
    "name": "GetProductRecipe",
    "group": "Inventory_/_Product_Recipes",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productRecipes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The product recipe with the specified ID</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductRecipeController.php",
    "groupTitle": "Inventory_/_Product_Recipes"
  },
  {
    "type": "get",
    "url": "/inventory/productRecipes",
    "title": "Fetch a list of product recipes",
    "name": "GetProductRecipes",
    "group": "Inventory_/_Product_Recipes",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productRecipes",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "payload",
            "description": "<p>A JSON array of product recipes</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "../../app/controllers/Inventory/ProductRecipeController.php",
    "groupTitle": "Inventory_/_Product_Recipes"
  },
  {
    "type": "put",
    "url": "/inventory/productRecipe/:id",
    "title": "Update a product category",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product recipe to be updated</p>"
          }
        ]
      }
    },
    "name": "UpdateProductRecipe",
    "group": "Inventory_/_Product_Recipes",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X PUT -d '{\n    \"label\": \"Recipe for 212 Bread\",\n    \"description\": \"The magic formula (I think)...\"\n}' http://api.zephirbms.code/inventory/productRecipes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The updated product recipe object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductRecipeController.php",
    "groupTitle": "Inventory_/_Product_Recipes"
  },
  {
    "type": "post",
    "url": "/inventory/productTypes",
    "title": "Create a product type",
    "name": "CreateProductType",
    "group": "Inventory_/_Product_Types",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"label\": \"Bakery\",\n    \"description\": \"Bakery stuff\"\n}' http://api.zephirbms.code/inventory/productTypes",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The newly created product type object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductTypeController.php",
    "groupTitle": "Inventory_/_Product_Types"
  },
  {
    "type": "delete",
    "url": "/inventory/productTypes/:id",
    "title": "Delete a product type",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product type to be deleted</p>"
          }
        ]
      }
    },
    "name": "DeleteProductType",
    "group": "Inventory_/_Product_Types",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X DELETE http://api.zephirbms.code/inventory/productTypes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The deleted product type object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductTypeController.php",
    "groupTitle": "Inventory_/_Product_Types"
  },
  {
    "type": "get",
    "url": "/inventory/productTypes/:id",
    "title": "Fetch a single product type by ID",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product type to be fetched</p>"
          }
        ]
      }
    },
    "name": "GetProductType",
    "group": "Inventory_/_Product_Types",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productTypes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The product type object with the specified ID</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductTypeController.php",
    "groupTitle": "Inventory_/_Product_Types"
  },
  {
    "type": "get",
    "url": "/inventory/productTypes",
    "title": "Fetch a list of all product types",
    "name": "GetProductTypes",
    "group": "Inventory_/_Product_Types",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.zephirbms.code/inventory/productTypes",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "payload",
            "description": "<p>A JSON array of product types</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductTypeController.php",
    "groupTitle": "Inventory_/_Product_Types"
  },
  {
    "type": "put",
    "url": "/inventory/productTypes/:id",
    "title": "Update a product type",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the product type to be updated</p>"
          }
        ]
      }
    },
    "name": "UpdateProductType",
    "group": "Inventory_/_Product_Types",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X PUT -d '{\n    \"label\": \"Bakery\",\n    \"description\": \"Bakery and related stuff...\"\n}' http://api.zephirbms.code/inventory/productTypes/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>The updated product type object</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/Inventory/ProductTypeController.php",
    "groupTitle": "Inventory_/_Product_Types"
  },
  {
    "type": "get",
    "url": "/movies",
    "title": "Fetches all movies",
    "name": "allMovies",
    "group": "Movies",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.BMS.code/movies",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>A json array of movies</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/MoviesController.php",
    "groupTitle": "Movies"
  },
  {
    "type": "get",
    "url": "/movie/:id",
    "title": "Fetches a single movie",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The ID of the movie to be returned</p>"
          }
        ]
      }
    },
    "name": "infoMovie",
    "group": "Movies",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.BMS.code/movie/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>Fetches information about the movie</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/MoviesController.php",
    "groupTitle": "Movies"
  },
  {
    "type": "get",
    "url": "/user/movies/unfav/:id",
    "title": "Removes a movie from user favorites",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The id of the movie</p>"
          }
        ]
      }
    },
    "name": "userMovieUnfav",
    "group": "Movies",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.BMS.code/user/movies/unfav/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>Favorite Status</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/UserController.php",
    "groupTitle": "Movies"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "Login a user",
    "name": "LoginUser",
    "group": "Users",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"email\": \"naruto@konoha.com\",\n    \"password\": \"ramen@123\" }' http://api.BMS.code/login",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>has information about the newly connected user</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/IndexController.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "/register",
    "title": "Registers a user",
    "name": "RegisterUser",
    "group": "Users",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X POST -d '{\n    \"firstName\": \"Naruto\",\n    \"lastName\": \"Uzumaki\",\n    \"emailAddress\": \"naruto@konoha.com\",\n    \"password\": \"ramen@123\"\n}' http://api.BMS.code/register",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>returns the newly created user</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/IndexController.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "/user/movies/fav/:id",
    "title": "Adds a movie to user favorites",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>The id of the movie</p>"
          }
        ]
      }
    },
    "name": "userMovieFav",
    "group": "User",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.BMS.code/user/movies/fav/3",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>Favorite status</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/movies",
    "title": "List all user favorite movies",
    "name": "userMoviesAll",
    "group": "User",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.BMS.code/user/movies",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "payload",
            "description": "<p>Returns list of favorite movies</p>"
          }
        ]
      }
    },
    "version": "0.0.1",
    "filename": "../../app/controllers/UserController.php",
    "groupTitle": "User"
  }
] });
