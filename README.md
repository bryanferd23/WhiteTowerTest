# How to run and test the solution

## System requirements

- PHP 8.1 or higher
- XAMPP with MySQL 5.7 or higher
- Composer
- Browser
- Git

## Installation

> 1. Clone the repository
> 2. Install dependencies
> 3. Configure the database
> 4. Run migrations

## 1. Clone the repository

- Create a new directory for the project and name it "WT_test"
- Navigate to the WT_test directory
- Run `git clone https://github.com/bryanferd23/WT_test.git`
- Download and copy the `.env` file from the repository to the root directory.

## 2. Install dependencies

- Run `composer install`

## 3. Configure the database

- Open the `.env` file and make sure the following settings are correct:
  - `database.default.hostname = localhost`
  - `database.default.database = wt_test`
  - `database.default.username = root`
  - `database.default.password = `
  - `database.default.DBDriver = MySQLi`
  - `database.default.port = 3306`
- If you have a different username and password setup, consider updating the .env file accordingly.
- Open XAMPP with admin privileges and start the MySQL and Apache services
- Go to `http://localhost/phpmyadmin`
- Create a MySQL database and name it "wt_test"

## 4. Run migrations

- Run `php spark migrate --all`

## Testing

1. Open XAMPP with admin privileges and start the MySQL service
2. Go to the root directory of the project and run `php spark serve` in the terminal
3. Open your browser and navigate to `http://localhost:8080`
4. You should see the default CodeIgniter page
5. Click the "Login" button located in the top right corner
6. You can start testing registration and login functionality
7. After registration, you can log in to test the rest of the functionality and logout.


