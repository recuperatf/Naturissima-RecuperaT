# Archivo de recuperación de `apprecuperat`

Este directorio contiene material de recuperación de una aplicación cuya base de datos MySQL se llama `apprecuperat`. No se ha encontrado aquí el código fuente de la aplicación ni un repositorio Git: el contenido principal son dos volcados SQL, un paquete de configuración de MySQL y directorios pequeños creados por Snap.

## Inventario

| Elemento | Tipo | Tamaño aproximado | Descripción |
| --- | --- | ---: | --- |
| `backup_apprecuperat_01_25_2023.sql` | Volcado MySQL | 17 MB | Copia fechada en 2023; 83 tablas y 82 sentencias de inserción |
| `backup_apprecuperat_23_02_2024.sql` | Volcado MySQL | 32 MB | Copia fechada en 2024; 89 tablas y 103 sentencias de inserción |
| `mysql-apt-config_0.8.12-1_all.deb` | Paquete Debian | 36 KB | Configuración del repositorio APT de MySQL; no es una copia de la base de datos |
| `snap/` | Datos de Snap | 36 KB | Directorios de `certbot` y `lxd`; no contienen una copia completa de sus servicios |

Los SQL fueron generados con MySQL 8 (`8.0.32` y `8.0.36`) desde `localhost`. El segundo es el respaldo más reciente y contiene tablas adicionales, por lo que debe tratarse como candidato principal para una restauración, sin borrar el de 2023.

## Alcance y datos sensibles

Los volcados contienen estructura y datos, no solo definiciones. Entre las tablas identificadas están:

- pacientes, historiales clínicos, diagnósticos, tratamientos y notas clínicas;
- usuarios, permisos, sesiones y restablecimientos de contraseña;
- clínicas, órdenes, productos, ejercicios, protocolos y recursos multimedia.

Esto puede incluir datos personales y sanitarios. Los archivos deben tratarse como confidenciales. No deben publicarse en un repositorio público, adjuntarse a incidencias ni copiarse a servicios externos sin autorización, cifrado y revisión legal/compliance.

## Exportar tablas a CSV

Sí, es posible extraer las tablas a CSV. Hay dos fuentes:

1. Los archivos `backup_*.sql`, que primero deben restaurarse en una base MySQL temporal.
2. La base viva `apprecuperat`, si se dispone de una cuenta MySQL autorizada.

La forma recomendada es restaurar el dump en una base aislada y exportar desde MySQL, porque un SQL no es un CSV: puede contener comas, saltos de línea, comillas y valores `NULL` que deben escaparse correctamente.

Ejemplo para una tabla después de restaurar el respaldo:

```sql
SELECT * FROM patients
INTO OUTFILE '/var/lib/mysql-files/patients.csv'
FIELDS TERMINATED BY ','
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY '"'
LINES TERMINATED BY '\n';
```

La cuenta debe tener el permiso `FILE` y el destino debe estar permitido por `secure_file_priv`. Como alternativa, una herramienta de exportación o un script que use el controlador MySQL puede escribir el CSV sin conceder `FILE`. Conviene exportar una tabla por archivo, conservar la fila de encabezados y registrar el esquema y la fecha.

No se hizo una exportación automática en esta revisión porque la autenticación local de MySQL rechazó una conexión administrativa sin contraseña y los datos pueden ser sanitarios. Antes de generar CSV reales hay que confirmar autorización, tablas necesarias y ubicación cifrada de salida.

## Sitios web conectados

Hay sitios web desplegados en esta máquina:

| Sitio | Aplicación | Base configurada | Estado observado |
| --- | --- | --- | --- |
| `https://recuperatfisioterapia.com` | Laravel `RecuperaT` en `/var/www/recuperat` | `apprecuperat` | Apache en 80/443 |
| `https://naturissimafarmacia.com` | Laravel `Naturissima` en `/var/www/naturissima` | `appnaturissima` | Apache en 80/443 |
| `http://recuperatfisioterapia.com:8520` | Documentación PHP generada | No aplica | Apache en 8520 |

También existe `/var/www/recuperat-backup`, otra copia del código de `RecuperaT`, y hay varios SQL históricos dentro de los directorios web. Apache, PHP-FPM y MySQL están activos. La base `apprecuperat` está configurada en la aplicación `RecuperaT`; la aplicación `Naturissima` usa una base diferente.

La existencia de un virtual host y una respuesta HTTP confirma que hay páginas servidas localmente, pero no demuestra que todos los dominios sean accesibles desde Internet, que el DNS apunte a esta máquina o que las credenciales de base sigan funcionando. No deben publicarse archivos `.env`, directorios de almacenamiento, dumps ni rutas internas.

## Comprobaciones iniciales

Desde `/root`:

```bash
file backup_apprecuperat_*.sql
sha256sum backup_apprecuperat_*.sql
```

Las sumas SHA-256 observadas en esta revisión son:

```text
backup_apprecuperat_01_25_2023.sql  7c6ef16505e1f465d9ba1a4c9f4be0ebf434e4719e885a8bef4de29031fa5e53
backup_apprecuperat_23_02_2024.sql  c0c651ffd5423f5df3eddb3f85442faf7b6250bab9ab75eb88c66837b716ebe6
```

Las sumas permiten detectar cambios o corrupción, pero no sustituyen al cifrado.

## Restauración local

### 1. Preparar una base de prueba

No restaures encima de una base de producción. Crea una base aislada y un usuario temporal con permisos limitados. El siguiente ejemplo requiere una cuenta administrativa de MySQL:

```bash
mysql -u root -p
```

```sql
CREATE DATABASE apprecuperat_restore
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'apprecuperat_restore'@'localhost'
  IDENTIFIED BY 'CAMBIAR_ESTA_CONTRASENA_LARGA';
GRANT ALL PRIVILEGES ON apprecuperat_restore.*
  TO 'apprecuperat_restore'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Usa una contraseña generada localmente; no la escribas en este README, en Git ni en el historial del shell.

### 2. Importar el respaldo de 2024

```bash
mysql --default-character-set=utf8mb4 \
  -u apprecuperat_restore -p \
  apprecuperat_restore < backup_apprecuperat_23_02_2024.sql
```

El respaldo no incluye necesariamente `CREATE DATABASE`, por eso se especifica la base de destino en el comando. Para probar el de 2023, usa otra base:

```bash
mysql -u root -p -e \
  "CREATE DATABASE apprecuperat_restore_2023 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql --default-character-set=utf8mb4 -u root -p \
  apprecuperat_restore_2023 < backup_apprecuperat_01_25_2023.sql
```

### 3. Verificar la restauración

```bash
mysql -u root -p apprecuperat_restore -e \
  "SHOW TABLES; SELECT COUNT(*) AS usuarios FROM users; SELECT COUNT(*) AS pacientes FROM patients;"
```

Compara también el número de tablas con el inventario del respaldo. Haz la prueba en un entorno sin acceso público y valida la aplicación antes de considerar la restauración válida.

## Crear un respaldo local nuevo

El respaldo debe hacerse con `mysqldump` desde el servidor MySQL, no copiando archivos internos de `/var/lib/mysql` mientras el servicio está activo:

```bash
set -o pipefail
fecha=$(date +%Y%m%d_%H%M%S)
mkdir -p /root/backups-local
umask 077
mysqldump --single-transaction --routines --triggers --events \
  --default-character-set=utf8mb4 \
  -u backup_user -p apprecuperat \
  | gzip -c > "/root/backups-local/apprecuperat_${fecha}.sql.gz"
sha256sum "/root/backups-local/apprecuperat_${fecha}.sql.gz" \
  > "/root/backups-local/apprecuperat_${fecha}.sha256"
```

`--single-transaction` reduce bloqueos para tablas transaccionales. Si existen tablas no transaccionales, hay que revisar la consistencia con el equipo de base de datos.

Conserva varias generaciones, prueba periódicamente una restauración y guarda al menos una copia en otro dispositivo o ubicación. Un respaldo que nunca se restaura es solo una suposición.

## ¿Se puede respaldar en GitHub?

Sí, técnicamente, pero **no se deben subir los SQL sin cifrar**. GitHub no es un destino apropiado para datos clínicos en texto plano, aunque el repositorio sea privado: los clones, cachés, forks, registros y copias de administradores amplían el perímetro de exposición.

### Opción recomendada

1. Crear un repositorio privado dedicado y activar la autenticación multifactor.
2. Cifrar el respaldo localmente con una clave gestionada fuera de GitHub.
3. Subir solo el archivo cifrado, su checksum y documentación sin datos reales.
4. Guardar la clave en un gestor de secretos o dispositivo seguro, separado del repositorio.
5. Probar la descarga, descifrado y restauración con una copia temporal.

Ejemplo con GPG usando una clave pública ya creada:

```bash
gpg --encrypt --recipient ID_O_CORREO_DE_LA_CLAVE \
  --output apprecuperat_2024.sql.gz.gpg \
  apprecuperat_2024.sql.gz
sha256sum apprecuperat_2024.sql.gz.gpg > apprecuperat_2024.sql.gz.gpg.sha256
```

Después de verificar el descifrado y la restauración, sube únicamente `.gpg`, `.sha256` y este README. El repositorio debe incluir un `.gitignore` que bloquee SQL, dumps, claves y archivos de entorno.

### Alternativas más adecuadas para producción

Para copias automáticas y de mayor tamaño, suele ser mejor usar almacenamiento de objetos con cifrado, control de acceso, retención/versionado e inmutabilidad, por ejemplo un bucket privado con KMS. GitHub puede conservar una copia cifrada secundaria, pero no debería ser el único respaldo ni el sistema principal de backup.

## Recuperación ante incidente

1. Identificar la versión y verificar su checksum.
2. Crear un servidor o base de datos aislada.
3. Restaurar y comprobar tablas, conteos y aplicación.
4. Rotar credenciales si el equipo sospecha exposición.
5. Registrar fecha, operador, versión restaurada y resultado.
6. No reemplazar producción hasta completar la validación funcional y de privacidad.

## Limitaciones de esta revisión

- No se encontró código fuente de la aplicación en `/root`.
- No se inspeccionaron registros de filas para evitar exponer información personal.
- `snap/` solo ocupa aproximadamente 36 KB en este árbol y no equivale a un backup completo de LXD o Certbot.
- No se ejecutó una restauración real porque requiere credenciales y un servidor MySQL de destino.

## Estado recomendado

El archivo de 2024 es la mejor base para una prueba de restauración. Antes de usarlo operativamente, conserva el original intacto, calcula y registra su checksum, cifra las copias secundarias, crea un respaldo más reciente desde MySQL y documenta quién está autorizado a restaurar datos.