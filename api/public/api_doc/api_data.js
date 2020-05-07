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
    "type": "get",
    "url": "/movies",
    "title": "Fetches all movies",
    "name": "allMovies",
    "group": "Movies",
    "examples": [
      {
        "title": "Example of use:",
        "content": "curl -i -X GET http://api.moviespace.code/movies",
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
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.moviespace.code/movie/3",
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
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.moviespace.code/user/movies/unfav/3",
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
        "content": "curl -i -X POST -d '{\n    \"email\": \"naruto@konoha.com\",\n    \"password\": \"ramen@123\" }' http://api.moviespace.code/login",
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
        "content": "curl -i -X POST -d '{\n    \"firstName\": \"Naruto\",\n    \"lastName\": \"Uzumaki\",\n    \"emailAddress\": \"naruto@konoha.com\",\n    \"password\": \"ramen@123\"\n}' http://api.moviespace.code/register",
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
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.moviespace.code/user/movies/fav/3",
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
        "content": "curl -i -X GET -d '{\"token\": \"...\"}' http://api.moviespace.code/user/movies",
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
