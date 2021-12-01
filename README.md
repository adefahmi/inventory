Clone the repository

```bash
https://github.com/adefahmi/inventory.git
git@github.com:adefahmi/inventory.git
```

Switch to the repo folder

```bash
cd inventory
```

Install all the dependencies using composer

```bash
composer install
```
Create database for this app, copy the example env file and make the required database configuration changes in the .env file

```bash
cp .env.example .env
```

Run the database migrations (**Set the database connection in .env before migrating**)

```bash
php artisan migrate
php artisan db:seed
```

Set App

```bash
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan optimize:clear
php artisan key:generate
php artisan jwt:secret
```

### Setup Local Development Server

```bash
php artisan serve
```
