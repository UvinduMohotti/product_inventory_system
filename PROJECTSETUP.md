# product_inventory_system

## Project Stack
```
PHP - 8.1
Laravel - 10 
Mysql - upto 5.7

```


## Project setup
```
composer install
```

### create .ENV file using .ENV.example


### Generate Key for Laravel Project 
```
php artisan key:generate
```


### Setup Mysql environment for project in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_inventory_system_db
DB_USERNAME={mysql server username}
DB_PASSWORD={mysql server password}
```

### Database Migration run with Seeders
```
php artisan migrate:fresh --seed
```

### Customize configuration
```
Admin email : admin@gmail.com
Admin password : Admin1234

User email : uvindu98@gmail.com
User password : ABC123

```

### Run the project 
```
php artisan serve
```
