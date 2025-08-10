# Invoice EBM

A Laravel-based Invoice Management System designed to help you create, manage, and track invoices efficiently.

## Features

- Create and manage invoices
- Client management
- Currency exchange rate support
- User authentication
- Role-based access control (optional)
- Export and print invoices

## Requirements

- PHP >= 8.1 or 8.2
- Composer
- MySQL or compatible database Or SQL Server 
- Node.js & NPM (optional, for frontend asset compilation)


1. Install PHP dependencies

composer install


2.Generate application key 

php artisan key:generate

3. Run migrations

php artisan migrate


4. (Optional) Seed the database

php artisan db:seed


5.  (Optional) Install frontend dependencies & compile assets

npm install
npm run dev


Start the development server: 

php artisan serve







## Installation

### 1. Clone the repository





```bash
git clone https://github.com/PanhaPhin/invociceebm.git
cd invociceebm
