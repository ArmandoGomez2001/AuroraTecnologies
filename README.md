poner los siguientes comando en la terminal de laragon

composer update

php artisan key:generate

poner en .env la base de datos creada y que este conectada

php artisan migrate

php artisan db:seed --class SeederTablaPermisos

php artisan db:seed --class SuperAdminSeeder

php artisan serve
