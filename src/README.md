Setup Project Currency side
===============================

### Add mailed dsn to .env file
~~~
Example
MAILER_DSN="smtp://user_name:password@sandbox.smtp.mailtrap.io:2525"
~~~

### Run command into php container
~~~
composer install
php bin/console doctrine:migrations:migrate
php bin/console debug:autowiring mailer

php bin/console app.check_currency_fiat_money threshold - threshold must be int or float type
~~~