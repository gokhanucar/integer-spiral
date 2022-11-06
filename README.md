**Demo project hosted on heroku**
[http://ucar-integer-spiral.herokuapp.com/api/documentation](http://ucar-integer-spiral.herokuapp.com/api/documentation)

## Prerequisites

- PHP ^8.0.2
- Composer v2
- Mysql Server Connection


## First Setup

Run following commands to install dependencies

- composer install (install php dependencies)
- copy .env.example file to .env


## Database instructions

- Check your .env file which database you want to use in your local machine (mysql info ready at .env.example file)
- Create a database schema named integer_spiral on your mysql server
  OR
- Enter the yes command during the next step for auto creation schema
- run following command: **php artisan migrate**


## Api Documentation Swagger
- run following command: **php artisan l5-swagger:generate**
- running in built in server: **php artisan serve**
- http://127.0.0.1:8000/api/documentation


## Running Tests
- run following command at project root directory: **"./vendor/bin/phpunit"**

