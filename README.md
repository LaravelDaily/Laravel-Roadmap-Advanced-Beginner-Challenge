# Laravel Roadmap: Advanced Beginner Level Challenge

This is my implementation for the [Advanced Beginner Level of the Laravel Roadmap](https://github.com/LaravelDaily/Laravel-Roadmap-Learning-Path#advanced-beginner-level), with the goal to implement as many of its topics as possible.

to make this project work, run the following commands: 
```
    $ git clone https://github.com/soufyaneyassin/Laravel-Roadmap-Advanced-Beginner-Challenge.git
    $ cp .env.example .env
```
i used [mailtrap.io](https://mailtrap.io) for email verification, you can register for free and put your credentials in the following section of .env file:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=username
MAIL_PASSWORD=password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="user@mailtrap.io"
MAIL_FROM_NAME="${APP_NAME}"
```
don't forget to configure the database.
continue the process with the following commands:
```
$ composer install 
$ npm install
$ npm run build
$ php artisan key:generate
$ php artisan migrate --seed
```
finally you can test with the following credentials : 
- admin@demo.com
* password

![soufyane-crm](https://user-images.githubusercontent.com/49349846/223405001-3bd84d3a-cc01-4791-9f8f-7a110e78015e.png)

