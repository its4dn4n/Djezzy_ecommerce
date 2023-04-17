# Functionalities used 
#### MVC : Model Controler View(JsonFile)
#### Passport Auth : Token + Refresh Token 
#### Costum Requests : store + update 
#### Traits : success + error response 
#### Resources 
#### Errors Handling: 404 + 403 + 500
#### Transactions
#### Middlewares : isAdmin

# Use Case 
#### Admin : 
#### -> Add category 
#### -> Add product 
#### -> 
#### User : 
#### -> Add to product to cart 
#### -> 

# Requiremnets 
#### Php ^8.2
#### Mysql ^5.7
#### Composer

#Setup
## laravel project 
####git clone {Poject}
####cd ./{project}
####cmd> composer install
####open {project}/.env file
####set your 
DB_HOST,
DB_PORT,
DB_DATABASE,
DB_USERNAME,
DB_PASSWORD
####cmd> php artisan serve
## start mysql server 

# Framework Used 
#### Laravel 10.0

# Routes 
  #### $baseUrl= {app host}
  #### Users Routes :
  #### get      $baseUrl/api/user             {}
  #### post     $baseUrl/api/user/update      {}
  #### delete   $baseUrl/api/user             {}
  #### get      $baseUrl/api/logout           {}
  #### Soon.. Swagger link  

