# GPS APP

ABM de gestión de vehículos empresariales con servicio de rastreo.

## Creado con:
- PHP/Laravel
- Bootstrap
- JavaScript
- PostgreSQL
- Google Maps API

## Funcionamiento

Permite administrar los vehículos de una empresa (que cuenten con gps), ofreciendo localización en tiempo real y notificaciones en caso de:
1. Frenada brusca
2. Límite de velocidad excedido
3. SOS

### Usuario Admin:
- Puede crear, editar y borrar Empresas y Vehículos.
- Puede ver Localizaciones y Notificaciones de cualquier vehículo

### Usuario Normal:
- Solo puede Editar Vehículos de su propia empresa
- Solo tiene acceso a los vehículos de su empresa (Localizaciones y Notificaciones)

## Configuraciones iniciales
### gps-app
1. Hacer una copia del archivo .env.example y renombrar a .env
2. Completar las variables correspondientes a la bd (las que tienen el prefijo "DB_"). Importante: DB_CONNECTION=pgsql
3. Ejecutar comandos 'npm install' y 'composer install' en la raiz del proyecto
4. Ejecutar comando 'php artisan key:generate'
5. Ejecutar migraciones y seeders con 'php artisan migrate --seed'. Esto crea 3 usuarios: admin, noadmin1 y noadmin2 (password: 12345678 para todos)
6. Levantar servidor con 'php artisan serve'
7. Ejecutar el simulador de vehículo ubicado en /gps-service para poder ver localización en tiempo real.
### gps-service
1. Instalar node.js
2. Ejecutar comando 'npm install' en la raiz (carpeta 'gps-service')
3. Verificar en el archivo config.js que el host y el puerto coincidan con los de 'gps-app'
4. Ejecutar comando 'node syncNotificacion' para insertar notificaciones de ejemplo
5. Ejecutar comando 'node syncLocalizacion' para poder observar un vehículo en tiempo real en el mapa
- OBS: El vehículo simulado tiene por defecto el imei '2749572958' que pertence a NGO SAECA (Chapa: KFB 957)



