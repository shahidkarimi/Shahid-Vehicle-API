# Vehicle API
This is a simple vehicle API to fetch modles and rating. This documentation explains input/output format as well as how to setup the application.
The API is built using **Laravel Lumen** with **guzzleHttp** package.

## Requirements
 * PHP 7.x
 * Apache or Nginx 
## How to Install
* `git clone https://github.com/shahidkarimi/Shahid-Vehicle-API.git`
* `cd Shahid-Vehicle-API`
* `composer install`

## How to Run
If you want to run the application using artisan command, run the following command within the root direcotry.

``
php -S localhost:8080 -t ./public
``

The application will run at 

`http://localhost:8080`

##### NOTE
 Since the application is not too much dependent on .env file in current context and it is not  included in the gitignore list. So you don't need to pay attention for the .env file.

## Run Tests
All scenarios mentioned in the requirement document are in test cases. In order to run test cases run `phpunit` if that don't work run `/vendor/bin/phpunit` command within root directory

## API Endpoints
### GET
    GET /vehicles/<vehicle ID>/<year>/<model>
    GET /vehicles/<vehicle ID>/<year>/<model>?withRating=<true | false>
### POST

    POST /vehicles
##### POST Payload

    {
      "modelYear": "<year>",
      "manufacturer": "<make>",
      "model": "<mmodel>"
    }
## OUTPUT
The output structure wil be a JSON