# Proyecto Final

# Instrucciones de Instalación

Este documento describe los pasos necesarios para configurar el entorno de desarrollo en la PC local bajo sistemas operativos Linux utilizando Docker.

### Pre instalación del Proyecto.

* Tener instalado **Git**.
* Tener instalado **Composer**.
* Tener **docker** y **docker-compose** instalados (utilizar las guías de Digital Ocean que estan bien documentadas).
* Tener instalado **php-client** **php-mbstring**.

### Clonar los repositorios de Github

Clonar lo repos en el directorio de elección.

* Repo de la **api** (backend):

``` 
git clone git@github.com:sbarrautn/ProyectoFinalBackEnd api
```

* Repo de la app **web** (frontend):

``` 
git clone git@github.com:sbarrautn/ProyectoFinalFrontEnd web
```

* Repo de los contenedores de **docker** (docker):

``` 
git clone git@github.com:sbarrautn/ProyectoFinalDocker docker
```

### Realizar la instalación de composer en el proyecto de la api.

```
https://getcomposer.org/download/
```
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
PD: Tener en cuenta que el hash de arriba siempre se actualiza por lo que es mejor entrar a la página de composer.

Copiamos el `composer.phar` de instalación que nos proveen los comandos anteriores en la carpeta raíz del proyecto de la api.

### Instalación de los contenedores de Docker.

1. Entrar en la carpeta de docker del proyecto. (`/docker`)

2. Ejecutar un `docker-compose pull`

3. Ejecutar un `docker-compose up -d`

4. Encender los contenedores con `docker-compose start` o `pfd start`

5. Para verificar que se encuentran los contenedores y ver sus estados `docker-compose ps`

6. Modificar el `.env` del docker agregando las rutas para cada repo.

7. (Opcional) Si queremos desentendernos de las IPs, modificar el host local `sudo /etc/hosts` mapeando las IPs con un dominio que reconozcamos facilmente. Por ej:
`10.5.0.2        api.proyecto.test`
`10.5.0.6        proyecto.test`

8. (Opcional) Para poder utilizar el comando `pfd` y que nos autocomplete los comandos: `pfd install-bash-completions`

9. (Opcional) Para poder utilizar el comando `pfd` desde cualquier directorio y no solo desde `/docker`:
    * Entramos para modificar nuestro `~/.profile`.
    * Agregar la siguiente línea `PATH="$HOME/dev/proyecto/docker/scripts/:$PATH"` al final de nuestro `~/.profile`.
    * Si queremos probar de que funciona sin tener que reiniciar, recargamos el nuevo path: `source ~/.profile`

### Contenedor de api (Backend)

Si queremos entrar al container de la api: `pfd commander` o `pfd bash` o `docker exec -it proyecto_api bash`.

### Contenedor de web (Frontend)

Si queremos entrar al container de la web: `pfd frontend-start` o `docker exec -it proyecto_web bash`.

### Instalación de las dependencias.

1. Acceder al Lord Commander (Ricky Fort) ejecutando `pfd commander` o `pfd bash` o `docker exec -it proyecto_api bash` (basicamente es nuestro bash de nginx)

2. Ejecutamos `./composer.phar install` para la descarga de las dependencias de Laravel.

### Crear archivo de Enviroment

1. Crear un archivo ```.env```

2. Copiar lo que existe en el ```.env.example```

3. Modificar las variables que sean necesarias.

4. Ejecutar para tener el `.env` completo y correcto `php artisan key:generate`.

Este archivo contiene las credenciales de las cuentas de los servicios utilizados.

### Configuración de la Base de Datos.

1. Instalar mysql-client

2. Ejecutamos `pfd bash database` o `docker exec -it proyecto_database bash` (con esto ingresamos al Mysql del docker)

4. Ejecutamos `mysql -uroot -psecret`

5. Creamos la BD: `create database proyecto;`

6. Verificamos la creación de la misma con: `show databases;`

7. Salimos si la creamos con éxito: `exit`.

### Ejecución de las migraciones (Laravel)

1. Primeramente actualizar el archivo `.env` con los datos correspondientes de la BD:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=proyecto
DB_USERNAME=root
DB_PASSWORD=secret
```

1. Entramos al bash de la api (Lord Commander) ubicados en `/docker` ejecutar: `pfd commander` o `pfd bash` o `docker exec -it proyecto_api bash`.

2. Ejecutamos dentro del bash `php artisan doctrine:clear:metadata:cache` para limpiar la cache de doctrine.

3. Ejecutamos dentro del bash `php artisan doctrine:migrations:migrate` o `php artisan doctrine:migrations:refresh` dependiendo del contexto de trabajo.

4. Una vez terminada la ejecución ya tendremos las tablas correspondientes en nuestra base de datos `proyecto`.

5. Listo! ya podemos salir del comandante: `exit`.
