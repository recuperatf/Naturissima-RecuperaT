# Naturissima

Aplicacion web de comercio electronico desarrollada con Laravel. El sistema
permite publicar productos naturales, organizarlos por categorias, gestionar
usuarios y pedidos, reservar citas y cobrar mediante OpenPay. Tambien contiene
modulos de bibliografia, busqueda, parametrizacion y carga de documentos.

## Estado tecnico

- Laravel `5.8`
- PHP `7.2` dentro de Apache
- MySQL `5.7`
- Vue `2`, Bootstrap `4`, Sass y Laravel Mix `4`
- PHPUnit `7`
- Integraciones configurables: OpenPay, PayPal, Google Drive, AWS S3 y SMTP
- Puertos Docker actuales: aplicacion `8001`, MySQL `8106`

Es una base de codigo legacy. PHP 7.2, MySQL 5.7 y Laravel 5.8 estan fuera de
soporte; conviene planificar una actualizacion antes de usarla en produccion.

## Funcionalidades principales

- Catalogo, categorias, imagenes y archivos de productos.
- Carrito, checkout, pedidos y envio de correos.
- Pagos con OpenPay y configuracion heredada de PayPal.
- Registro, inicio de sesion, usuarios y roles de administracion.
- Citas y horarios disponibles.
- Bibliografia, historial de busquedas y parametrizacion.
- Almacenamiento local, Amazon S3 o Google Drive mediante configuracion.

## Estructura del proyecto

```text
app/                 Modelos, controladores, correo y proveedores
config/              Configuracion de Laravel y servicios externos
database/            Migraciones, factories y seeds
public/              Punto de entrada Apache y recursos publicos
resources/views/     Plantillas Blade de tienda y administracion
resources/js|sass/   Fuentes del frontend
routes/              Rutas web y API
storage/             Logs, cache y archivos de Laravel
run/var/             Datos persistentes de MySQL en Docker
home_mysql/          Copias SQL y directorio montado en MySQL
backup/              Archivos de respaldo existentes
```

## Requisitos

Para la forma recomendada de ejecucion solo se necesita:

- Docker Engine.
- Docker Compose (`docker compose` o `docker-compose`).
- Git.

Para compilar los recursos frontend fuera de Docker se necesita Node.js/npm.
Para ejecutar PHP fuera de Docker se requieren PHP 7.2, Composer y las
extensiones declaradas por el Dockerfile.

## Instalacion con Docker

### 1. Obtener el codigo

```bash
git clone <URL_DEL_REPOSITORIO> naturissima
cd naturissima
```

### 2. Preparar el entorno

```bash
cp .env.example .env
```

Edita `.env` y configura, como minimo:

```dotenv
APP_NAME=Naturissima
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8001
DB_CONNECTION=mysql
DB_HOST=mysql-db-naturissima
DB_PORT=3306
DB_DATABASE=appnaturissima
DB_USERNAME=luis
DB_PASSWORD=<CONTRASENA_DE_MYSQL>
```

Dentro de Docker, `DB_HOST` debe ser el nombre del servicio
`mysql-db-naturissima`, no `localhost`. La base de datos se crea con los
valores definidos en `docker-compose.yml`; cambia esos valores antes de usar
el sistema fuera de un entorno local.

### 3. Construir la imagen de PHP

El compose actual referencia la imagen local
`recuperat-laravel-docker_laravel-app:latest`, pero no declara una seccion
`build`. Si la imagen no existe, construyela manualmente:

```bash
docker build --build-arg uid="$(id -u)" \
  -t recuperat-laravel-docker_laravel-app:latest .
```

El Dockerfile usa PHP 7.2, por lo que la construccion puede fallar en
distribuciones o repositorios actuales. En ese caso hay que actualizar la base
de PHP y las dependencias antes de continuar.

### 4. Iniciar los servicios

```bash
docker-compose up -d
docker-compose ps
```

Abre <http://localhost:8001>. Para ver errores:

```bash
docker-compose logs -f laravel-app
docker-compose logs -f mysql-db-naturissima
```

### 5. Inicializar Laravel

```bash
docker-compose exec laravel-app php artisan key:generate
docker-compose exec laravel-app php artisan migrate
docker-compose exec laravel-app php artisan storage:link
```

Usa `migrate --seed` solo si los seeders del entorno contienen los datos que
necesitas. Para restaurar una base existente, utiliza el procedimiento de la
seccion de respaldos en lugar de ejecutar migraciones a ciegas.

## Comandos de desarrollo

El repositorio incluye accesos directos para trabajar dentro del contenedor:

```bash
./container                         # Shell del contenedor PHP
./composer install                  # Dependencias PHP
./composer dump-autoload            # Regenerar autoload
./php-artisan migrate               # Comandos Artisan
./phpunit                           # Ejecutar PHPUnit
```

Frontend:

```bash
npm install
npm run development                 # Compilacion de desarrollo
npm run watch                       # Compilacion al cambiar archivos
npm run production                  # Compilacion para produccion
```

Dentro del contenedor tambien se pueden usar directamente `composer` y
`php artisan`. Despues de modificar configuracion, limpia la cache cuando sea
necesario:

```bash
./php-artisan config:clear
./php-artisan cache:clear
./php-artisan view:clear
```

## Configuracion de servicios

Las credenciales y claves deben vivir en `.env`, nunca en GitHub:

- `OPENPAY_ID`, `OPENPAY_SK`, `OPENPAY_PK` y modo de produccion.
- Variables `PAYPAL_*` para sandbox o produccion.
- `MAIL_*` para correos.
- `AWS_*` y `FILESYSTEM_DRIVER=s3` para S3.
- `GOOGLE_DRIVE_*` y `FILESYSTEM_DRIVER=google` para Google Drive.
- `APP_KEY` y las variables `DB_*`.

No uses las credenciales que aparecen actualmente en configuraciones o vistas.
Deben revocarse y regenerarse, especialmente las de PayPal, OpenPay y el
usuario remoto de Git. El repositorio contiene un remoto con credenciales
embebidas en su URL; elimina esa URL y vuelve a configurarlo con SSH o un
token de GitHub:

```bash
git remote set-url origin git@github.com:ORGANIZACION/naturissima.git
git remote -v
```

Si una clave ya fue subida a cualquier commit, cambiarla en `.env` no la
elimina del historial. Rota la clave y revisa el historial con una herramienta
como `git filter-repo` antes de publicar el repositorio.

## Pruebas

```bash
./phpunit
```

La suite existente es pequeña; antes de una puesta en produccion conviene
agregar pruebas para autenticacion, checkout, pagos, pedidos y permisos de
administracion.

## Respaldos

### Respaldo local del codigo

El codigo puede respaldarse con Git y con un archivo comprimido. No incluyas
`.env`, `vendor`, `node_modules`, caches ni secretos:

```bash
git status
git add .
git commit -m "Punto de respaldo"
git tag backup-$(date +%Y%m%d-%H%M%S)

tar --exclude=.git --exclude=.env --exclude=vendor \
    --exclude=node_modules --exclude=run/var \
    -czf ../naturissima-codigo-$(date +%Y%m%d-%H%M%S).tar.gz .
```

Conserva el archivo fuera del directorio del proyecto y, preferiblemente, en
otro disco o ubicacion.

### Respaldo local de MySQL

Haz el dump mientras el contenedor esta activo:

```bash
mkdir -p backups
docker-compose exec -T mysql-db-naturissima \
  mysqldump -u root -p appnaturissima \
  > backups/appnaturissima-$(date +%Y%m%d-%H%M%S).sql
```

El comando pedira la contrasena de root configurada en `docker-compose.yml`.
No guardes esa contrasena en el README ni en Git. Tambien existe persistencia
en `run/var`; no la copies mientras MySQL esta escribiendo. El dump SQL es el
respaldo portable recomendado.

Restauracion:

```bash
cat backups/appnaturissima-AAAAMMDD-HHMMSS.sql | \
  docker-compose exec -T mysql-db-naturissima \
  mysql -u root -p appnaturissima
```

Verifica cada respaldo en una base de prueba; un archivo `.sql` que nunca se
ha restaurado no debe considerarse comprobado.

### Archivos subidos

Revisa y respalda tambien `public/images`, `storage/app` y cualquier carpeta
usada por el disco configurado. Actualmente `.gitignore` excluye
`public/images/*` y `run/var`, por lo que esos datos no quedan cubiertos por un
`git push`. Si el almacenamiento real es S3 o Google Drive, respalda tambien
ese proveedor y conserva sus credenciales de forma separada.

### Respaldo en GitHub

Si el repositorio de GitHub es privado, GitHub puede guardar el codigo y su
historial:

```bash
git remote set-url origin git@github.com:ORGANIZACION/naturissima.git
git push -u origin e-commerce
git push origin --tags
```

Esto es posible, pero GitHub no sustituye un backup de MySQL, de imagenes ni
de `.env`. Para los archivos grandes usa Git LFS o un almacenamiento de
objetos; no subas dumps con datos personales o credenciales a un repositorio
publico. Manten al menos una copia local y otra en una ubicacion independiente
y prueba periodicamente la restauracion.

## Problemas conocidos y recomendaciones

1. Corregir `DB_HOST` de `.env.example` para que coincida con el servicio
   Docker.
2. Añadir `build:` a `docker-compose.yml` o documentar y publicar la imagen
   necesaria en un registro controlado.
3. Sacar todas las credenciales de `config/paypal.php` y de las vistas.
4. Regenerar `composer.lock` y fijarlo al repositorio para instalaciones
   reproducibles.
5. Actualizar Laravel, PHP, dependencias de frontend y MySQL con una migracion
   planificada y pruebas de pagos.
6. Revisar autenticacion, permisos, validacion de archivos y rutas de prueba
   antes de exponer la aplicacion a Internet.

## Licencia

El proyecto declara licencia MIT en `composer.json`. Confirma que esa licencia
sea la deseada para el codigo y para los recursos de terceros antes de
redistribuirlo.
