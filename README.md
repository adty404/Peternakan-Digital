# ![Aplikasi Peternakan](logo.png)

![Build Status](https://wakatime.com/badge/user/7a01bed2-a6a3-4e98-8055-d76ffbd563e7/project/71a2de7c-fee2-408f-bbf7-a7dfc505acd1.svg)

> ### Aplikasi Peternakan Digital dengan QRCode dan memiliki 4 roles: Master, Super Admin, Admin, dan Operator.

----------

# Getting started

## Requirements

* PHP >= 7.3.5
* Imagick

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:adty404/Peternakan-Digital.git

Switch to the repo folder

    cd peternakan-digital-master

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:adty404/Peternakan-Digital.git
    cd peternakan-digital-master
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Seeders untuk data login Master, Super Admin, Admin, dan Operator. Data perusahaan, peternakan, kategori, dan hewan.**

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
## Usage

**Data login Master, Super Admin, Admin, dan Operator.**

* Master = master@peternakan.com || 12345678
* Super Admin = super-admin@peternakan.com || 12345678
* Admin = admin@peternakan.com || 12345678
* Operator = operator@peternakan.com || 12345678

## Credits

**Credit to Aditya Prasetyo.**
