## About Weather Broadcast
This application is created as a test task according to the technical task


### First enviroment setup
To set up this project you need to have:
- PHP 7.4 or higher
- Laravel 8

#### Execute the following actions :

- clone the project from the repository
- create DB for example "weather"
- add DB credentials to .env file
- run 'composer install'
- run 'php artisan key:generate'
- run 'php artisan migrate'

#### After all this steps run following command to import data from API (https://eonet.gsfc.nasa.gov/docs/v2.1)
Please be careful and run them in the same order they are listed

- run 'php artisan import:categories'
- run 'php artisan import:events'

Now you can start the localhost using artisan serve,Mamp etc.

#### If you want update the data from API you can rerun import command and new data will be added.






