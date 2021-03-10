Prerequisites

Install Xampp

Install Composer https://getcomposer.org/ A Dependency Manager for PHP

Include Php in your Environment Variables on your OS

Install Git

Open Xampp and start Apache and Mysql
open with Git Bash your project folder

Run :   

        1)composer install

        2)php artisan migrate

        3)php artisan jwt:secret

        open your .env file in folder project and add the output
        e.g.
        JWT_SECRET=8Wtr0PN82tuBaOqpdMOYkyO5LzxSvnkKXvZeEy0icZI7nLhXnwJ5svrSN7JD9ruZ

        4)also in your .env modify the following for automatic email function
        
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.googlemail.com
        MAIL_PORT=587
        MAIL_USERNAME=youremail@gmail.com
        MAIL_PASSWORD=password
        MAIL_ENCRYPTION=ssl
        MAIL_FROM_ADDRESS=null
        MAIL_FROM_NAME="${APP_NAME}"

        5) Run: php artisan serve 

Be sure that in fti-backend => config => cors.php file in the returned array in 'allowed_origins' your frontend link is included.

Enjoy :) 