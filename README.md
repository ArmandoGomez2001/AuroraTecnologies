Utilice el branch proyectazo!

poner los siguientes comando en la terminal de laragon

composer update

php artisan key:generate

poner en .env la base de datos creada y que este conectada

php artisan migrate

php artisan db:seed --class SeederTablaPermisos

php artisan db:seed --class SuperAdminSeeder

php artisan serve


Para que funcione la grafica en SQL server:

CREATE TABLE medidor (
  id INT IDENTITY(1,1) NOT NULL,
  kw INT NULL,
  horas VARCHAR(50) NULL,
  PRIMARY KEY (id)
);

INSERT INTO medidor (kw, horas) VALUES (80, '12:00');
INSERT INTO medidor (kw, horas) VALUES (250, '01:00');
INSERT INTO medidor (kw, horas) VALUES (180, '02:00');
INSERT INTO medidor (kw, horas) VALUES (200, '03:00');
INSERT INTO medidor (kw, horas) VALUES (250, '04:00');
