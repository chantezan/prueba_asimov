#Para correr aplicacion:
Se debe tener instalado php 7, node y composer
1. cambiar nombre a .env.example a .env
2. crear una "base de datos con nombre prueba_asimov o cambiar la configuracion de .env
3. composer install
4. php artisan migrate --seed // esto genera las tablas y crea el schedule
5. npm install
5. npm run watch //para generar app.js

Solo se puede agendar para el año 2019, mediante el cliente web solo se puede agendar 
por bloques de 1 hora desde las 9 hasta las 5, si quiere otra combinacion de horas se puede
usar la API.
Hay test para la API en test/Feature/APITest.php

#Documentacion api:
la url base del servidor es http://45.58.41.61/prueba_asimov/public/

* Crear reserva /store: 

  name: requerido , last_name: requerido, email: requerido | formato email, 
  date: requerido | formato date(YYYY-mm-dd G:i e.g 2019-02-03 15:32) ,
phone: opcional

* Editar reserva /edit:

  id: requerido, name: opcional , last_name: opcional, email: opcional | formato email, 
date: opcional | formato date(YYYY-mm-dd G:i e.g 2019-02-03 15:32) ,phone: opcional

* Ver reservas /show: 

  to : requerido | formato date(YYYY-mm-dd e.g 2019-02-03) | fecha inicio
from: requerido | formato date(YYYY-mm-ddme.g 2019-02-03) | fecha final

* Eliminar reserva /delete_book:

  id: requerido

