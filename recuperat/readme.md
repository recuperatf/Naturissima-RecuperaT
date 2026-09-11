# Laravel + Apache + Docker

## Description
Start developing a fresh Laravel application with `docker` using `docker-compose`.

The images used in this repo is `php:7.2-apache` and `mysql:5.7`. The goal is to make setting up the development as simple as possible.

## Up and running
Clone the repo:
```
$ git clone https://github.com/laravel/laravel.git
# RecuperaT

Aplicacion web de gestion de fisioterapia y rehabilitacion construida con
Laravel. El sistema incluye pacientes, historias clinicas, valoraciones,
diagnosticos, tratamientos, planes terapeuticos, citas, laboratorio, biblioteca,
productos, pedidos y pagos.

## Estado del proyecto

- Framework: Laravel 6.20.44.
- PHP del proyecto: `^7.1.3`; la imagen Docker usa PHP 7.2 con Apache.
- Base de datos: MySQL 5.7.
- Frontend: Vue 2, Bootstrap 4, Sass y Laravel Mix 4.
- Redis esta contemplado en la configuracion, pero la cola usa `sync` y la
  cache y sesiones usan archivos por defecto.
- Integraciones: correo SMTP, Stripe, OpenPay, PayPal, Google Drive y generacion
  de PDF.
- URL configurada en el entorno actual: `https://recuperatfisioterapia.com/`.

## Modulos principales

La aplicacion se organiza principalmente alrededor de estos dominios:

- Usuarios, roles, permisos y espacios de trabajo.
- Pacientes, antecedentes, historias clinicas y notas clinicas.
- Valoraciones, diagnosticos CIE-9/CIE-10, ejercicios y evaluaciones.
- Planes y protocolos de fisioterapia, tratamientos y sesiones.
- Citas, clinicas, empresas y solicitudes de informacion.
- Ordenes de laboratorio, productos, ofertas, carrito y pedidos.
- Biblioteca, bibliografia, recursos externos y metadatos DSpace.
- Carga de imagenes y documentos en `public/` y `storage/`.

Los endpoints web estan en `routes/web.php` y los endpoints API en
`routes/api.php`. La logica HTTP esta en `app/Http/Controllers`, los modelos
Eloquent en `app/` y las vistas Blade en `resources/views`.

## Requisitos

Para la instalacion Docker:

- Docker Engine.
- Docker Compose.
- Git.
- Al menos 2 GB libres para la aplicacion, dependencias y base de datos.

Para trabajar sin Docker se necesita PHP compatible con Laravel 6, Composer,
MySQL 5.7 y Node.js/npm compatibles con Laravel Mix 4. Docker es la opcion
recomendada porque fija Apache, PHP y MySQL.

## Instalacion con Docker

1. Clonar el repositorio y entrar en su raiz:

	```bash
	git clone <URL_DEL_REPOSITORIO>
	cd recuperat
	```

2. Crear la configuracion local:

	```bash
	cp .env.example .env
	```

	Ajustar al menos `APP_URL`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME` y
	`DB_PASSWORD`. Dentro de Docker, el host de MySQL debe ser
	`mysql-db-recuperat`, no `localhost`.

3. Arrancar los servicios:

	```bash
	docker-compose up -d
	```

	El compose actual referencia la imagen local
	`recuperat-laravel-docker_laravel-app:latest`; no contiene una seccion
	`build`. Esa imagen debe existir previamente. Si no existe, construirla con
	 `Dockerfile/Dockerfile` y volver a ejecutar `docker-compose up -d`:

	 ```bash
	 docker build --build-arg uid=$(id -u) \
		 -t recuperat-laravel-docker_laravel-app:latest \
		 -f Dockerfile/Dockerfile .
	 ```

	 La imagen debe poder compilarse con las dependencias antiguas del proyecto;
	 si el build falla, conservar la imagen de trabajo existente y revisar la
	 compatibilidad de PHP 7.2 con el sistema operativo del host.

	 La aplicacion queda publicada en `http://localhost:8006` y MySQL en el
	 puerto local `6969`.

4. Instalar dependencias y generar la clave:

	```bash
	docker-compose exec laravel-app composer install
	docker-compose exec laravel-app php artisan key:generate
	docker-compose exec laravel-app php artisan storage:link
	```

5. Crear el esquema de base de datos:

	```bash
	docker-compose exec laravel-app php artisan migrate
	docker-compose exec laravel-app php artisan db:seed
	```

	Los dumps SQL existentes son respaldos o catalogos historicos, no una
	migracion automatica. Para importar uno, usar el procedimiento de
	restauracion descrito mas abajo y hacer primero una copia de seguridad.

## Frontend y comandos utiles

El `Dockerfile` actual no instala Node.js/npm. Instalar las dependencias
frontend en el host, o usar una imagen de Node compatible:

```bash
npm install
npm run dev
npm run production
```

Los archivos compilados se generan en `public/js` y `public/css`.

Comandos Laravel frecuentes:

```bash
docker-compose exec laravel-app php artisan route:list
docker-compose exec laravel-app php artisan migrate:status
docker-compose exec laravel-app php artisan cache:clear
docker-compose exec laravel-app php artisan config:clear
docker-compose exec laravel-app php artisan queue:failed
```

Los scripts `container`, `composer`, `php-artisan`, `phpunit` y `db` son
atajos antiguos y actualmente referencian nombres de contenedor distintos a
los definidos en `docker-compose.yml`. Usar `docker-compose exec` hasta que
sean actualizados.

## Pruebas

Ejecutar:

```bash
docker-compose exec laravel-app ./vendor/bin/phpunit
```

El repositorio contiene actualmente las pruebas de ejemplo de Laravel. Antes
de una puesta en produccion conviene agregar pruebas para autenticacion,
historias clinicas, pagos, cargas de archivos y restauracion de datos.

## Respaldo local

Si MySQL esta levantado con este `docker-compose.yml`, crear un dump comprimido
fuera del repositorio:

```bash
mkdir -p ../backups/recuperat
docker exec recuperat_db mysqldump -uroot -p --single-transaction --routines --triggers apprecuperat | gzip > ../backups/recuperat/db-$(date +%F_%H%M%S).sql.gz
```

El comando solicitara la contrasena de MySQL. No escribirla en el historial de
la shell. Respaldar tambien los archivos subidos y configuraciones necesarias,
sin incluir `.env` en texto plano:

```bash
tar --exclude='./vendor' --exclude='./node_modules' --exclude='./run/var' \
	 --exclude='./storage/framework' --exclude='./storage/logs' \
	 -czf ../backups/recuperat/files-$(date +%F_%H%M%S).tar.gz public/images public/files storage/app/public
```

Mantener al menos tres copias, en discos distintos, y probar periodicamente
que una copia puede restaurarse. Los dumps SQL que ya existen en la raiz
incluyen uno de aproximadamente 54 MB y pueden contener datos personales o
clinicos; deben cifrarse y tratarse como informacion confidencial.

## Restauracion local

1. Levantar MySQL y crear la base de datos si aun no existe.
2. Descomprimir e importar el dump:

	```bash
	gunzip -c ../backups/recuperat/db-FECHA.sql.gz | \
	  docker exec -i recuperat_db mysql -uroot -p apprecuperat
	```

3. Restaurar `public/images`, `public/files` y `storage/app/public` desde el
	archivo de ficheros.
4. Configurar un `.env` local con credenciales de prueba y limpiar caches:

	```bash
	docker-compose exec laravel-app php artisan optimize:clear
	docker-compose exec laravel-app php artisan storage:link
	```

Nunca restaurar un dump real en desarrollo sin anonimizar previamente los
	datos de pacientes.

## GitHub: que se puede respaldar

Si, es posible usar GitHub para respaldar el codigo fuente, configuraciones de
ejemplo, migraciones, pruebas y documentacion. No debe usarse como unico
respaldo de la base de datos ni de los archivos clinicos.

Antes de publicar:

1. Rotar inmediatamente las credenciales que hayan estado en `.env` o en
	cualquier historial: `APP_KEY`, SMTP, Stripe, OpenPay, Google Drive y otras
	claves de terceros. El archivo local actual contiene secretos de produccion.
2. Revisar el historial completo, no solo el estado actual:

	```bash
	git log --all -- .env sftp-config.json '*.sql'
	git grep -nE 'sk_live|password|SECRET|ACCESS_TOKEN|PRIVATE_KEY' $(git rev-list --all) -- 2>/dev/null
	```

3. Confirmar que `.env`, `sftp-config.json`, `run/var`, uploads, logs y dumps
	reales no se suban. `.gitignore` ya excluye varios de ellos, pero cada
	archivo debe verificarse con `git ls-files`.
4. Publicar un `.env.example` sin valores reales y proteger el repositorio como
	privado, con MFA y acceso minimo.
5. Configurar un remoto y subir solo el codigo revisado:

	```bash
	git remote add origin git@github.com:ORGANIZACION/recuperat.git
	git add .
	git status
	git commit -m "Documenta instalacion y respaldos"
	git push -u origin main
	```

Para datos sensibles usar un almacenamiento cifrado con control de acceso,
versionado y retencion. GitHub Releases o Git LFS no sustituyen un sistema de
backup cifrado y tampoco deben recibir datos clinicos sin una evaluacion legal
y de privacidad.

## Seguridad y operacion

- No subir `.env`, contrasenas, tokens, claves privadas, dumps ni fotografias
  de pacientes.
- Cambiar las contrasenas de ejemplo del `docker-compose.yml` antes de usarlo
  fuera de un entorno local aislado.
- Mantener `APP_DEBUG=false` en produccion y usar HTTPS.
- Limitar el acceso a MySQL; el compose actual publica el puerto `6969` en el
  host.
- Revisar permisos de `storage/` y `bootstrap/cache/`.
- Registrar quien puede exportar, descargar o restaurar informacion clinica.
- Separar credenciales de desarrollo, pruebas y produccion.

## Estructura resumida

```text
app/                 Modelos, controladores, correo y servicios
config/              Configuracion de Laravel e integraciones
database/            Migraciones, factories y seeders
public/              Entrada web, assets y archivos publicos
resources/views/     Vistas Blade
resources/js/        Componentes Vue y entrada frontend
routes/              Rutas web, API, canales y consola
storage/             Logs, cache, sesiones y archivos generados
tests/               Pruebas PHPUnit
docker-compose.yml   Aplicacion Apache/PHP y MySQL
Dockerfile/          Imagen PHP 7.2 Apache
```

## Licencia

El proyecto hereda la declaracion MIT del esqueleto Laravel en
`composer.json`. Confirmar las condiciones de las dependencias y la politica
de licencia de RecuperaT antes de distribuirlo.
