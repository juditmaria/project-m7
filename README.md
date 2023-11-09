# Proyecto de M7
Propuesta de solución al proyecto dentro del módulo de M7 de 2do de DAW.
  
## Preparación de entorno
Clona el directorio del proyecto:

    git clone https://github.com/juditmaria/project-m7.git

Instala las **dependencias de Composer** que *no se incluyen en el control de versiones* debido a las restricciones establecidas en el archivo **.gitignore**:

    php .././composer install

Creacion del archivo **.env**:

    nano .env

    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:QSh0sW0vhZSrDMKDOPrnKAqAJKAPjO9eMsV34eo17G4=
    APP_DEBUG=true
    APP_URL=http://localhost
    
    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug
    
    # DB_CONNECTION=sqlite
    # DB_DATABASE=../database/database.sqlite
    
    DB_CONNECTION=mysql
    DB_HOST=hl1216.dinaserver.com
    DB_PORT=3306
    DB_DATABASE=daw2_08
    DB_USERNAME=daw2_08
    DB_PASSWORD=dKt49z441![*
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    MEMCACHED_HOST=127.0.0.1
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=2daw.equip08@fp.insjoaquimmir.cat
    MAIL_PASSWORD=dKt49z441![*
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=2daw.equip08@fp.insjoaquimmir.cat
    MAIL_FROM_NAME="${APP_NAME}"
    
    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=
    AWS_USE_PATH_STYLE_ENDPOINT=false
    
    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_HOST=
    PUSHER_PORT=443
    PUSHER_SCHEME=https
    PUSHER_APP_CLUSTER=mt1
    
    VITE_APP_NAME="${APP_NAME}"
    VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    VITE_PUSHER_HOST="${PUSHER_HOST}"
    VITE_PUSHER_PORT="${PUSHER_PORT}"
    VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
    VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    
    ADMIN_NAME=daw2_08
    ADMIN_EMAIL=2daw.equip08@fp.insjoaquimmir.cat
    ADMIN_PASSWORD=dKt49z441![*

Instalar e iniciar npm

    npm install
    npm run dev

Enlazar las carpetas donde se guardan los archivos

    php artisan storage:link 



