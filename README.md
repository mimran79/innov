# Innov - E-Commerce Application

An e-commerce web application built with Laravel 13 and Breeze 2.4.

---

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js & NPM

---

## Installation Guide

1. **Clone the repository:**

   git clone <YOUR_REPOSITORY_URL>
   cd innov

2. **Install PHP dependencies:**

composer install

3. **Install & built frontEnd assets**

npm install
npm run build

4.**Update Enviroment Vairables**

Open .env 
1-Change Debug more to true (to see any error of bug)
2-Change the domain to localhost
3-Change Database Details
4-Change SMPT variables to receive order confirmation email

5. **Create & My SQL Database**
On your local phpmyadmin, create a database and use the same name you used in .env file

6. **Check Seed File & Run Migration**

1-Open the database/seeder/DatabaseSeeder.php & check the dummy users details for login or modify as you want

2-php artisan migrate: refresh --seed

7. **Create a strorage link**

php artisan strorage:link

8. **Run the Application**

php artisan serve
