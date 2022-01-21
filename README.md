# Sparta Connect
Sparta connection app
![Sparta Connect Screenshot](https://raw.githubusercontent.com/abdul15irsyad/sparta-connect/master/public/images/login-sparta-connect.jpeg)

## Tech Stack
- PHP 7.4+
- Laravel 8
- Bootstrap 5 (Web) & Bootstrap 4 (Admin)


## Installation
1. clone the repo (in terminal or bash) and then install all dependencies with composer

```bash
git clone https://github.com/abdul15irsyad/sparta-connect sparta-connect
cd sparta-connect
composer install
```

2. after all the existing dependecies installed then duplicate file `.env.example`, rename it to `.env` then setup environment based on yours (database, smtp, etc)

3. run mysql local (with XAMPP if u use it) and create database on your local machine (make sure the database information is equal with the `.env`)

4. generate laravel app key by running

```bash
php artisan key:generate
```

5. run the migration for creating table also run the seeder
```bash
php artisan migrate --seed
```

6. run the application
```bash
php artisan serve
```

7. if you want to use some email function run `queue:work` dont forget to setup the smtp (use your mailtrap account) in `.env`
```bash
php artisan queue:work
```