# Sabra Music Deployment Guide

This guide provides instructions for deploying the Sabra Music application to a production environment.

## Prerequisites

- A web server (Apache, Nginx, etc.)
- PHP 7.3 or higher
- MySQL or another database supported by Laravel
- Composer
- Git (optional)

## Deployment Steps

### 1. Obtain the Application Code

Clone the repository or upload the application files to your server:

```bash
git clone https://github.com/Piumalhk/Sabra-Music.git
cd Sabra-Music/sabra-music
```

### 2. Install Dependencies

Install PHP dependencies:

```bash
composer install --no-dev --optimize-autoloader
```

Install Node.js dependencies and build assets:

```bash
npm install
npm run prod
```

### 3. Configure Environment Variables

Copy the example environment file and update it with your production settings:

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file and update the following settings:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-user
DB_PASSWORD=your-database-password
```

### 4. Set Up the Database

Run migrations to set up the database schema:

```bash
php artisan migrate --force
```

Seed the database with initial data (if needed):

```bash
php artisan db:seed
```

### 5. Create Storage Link

Create a symbolic link for the storage directory:

```bash
php artisan storage:link
```

### 6. Set Directory Permissions

Ensure the proper permissions are set on the storage and bootstrap/cache directories:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

Replace `www-data` with the appropriate web server user (e.g., `apache`, `nginx`).

### 7. Configure Web Server

#### Apache

Create a virtual host configuration in `/etc/apache2/sites-available/sabra-music.conf`:

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    ServerAdmin webmaster@your-domain.com
    DocumentRoot /path/to/Sabra-Music/sabra-music/public

    <Directory /path/to/Sabra-Music/sabra-music/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Enable the site:

```bash
a2ensite sabra-music.conf
a2enmod rewrite
systemctl reload apache2
```

#### Nginx

Create a server block configuration in `/etc/nginx/sites-available/sabra-music`:

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/Sabra-Music/sabra-music/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:

```bash
ln -s /etc/nginx/sites-available/sabra-music /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

### 8. Optimize Laravel for Production

Cache configuration and routes:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 9. Transferring User Uploads

If migrating from an existing installation, transfer uploaded files:

1. On the old server, run the backup script:
   ```bash
   php backup-uploads.php
   ```

2. Copy the generated backup directory to the new server.

3. On the new server, navigate to the backup directory and run:
   ```bash
   php restore.php
   ```

### 10. Set Up SSL (Recommended)

For secure HTTPS connections, set up SSL certificates using Let's Encrypt:

```bash
sudo certbot --apache -d your-domain.com
```

Or for Nginx:

```bash
sudo certbot --nginx -d your-domain.com
```

### 11. Set Up a Scheduled Task for Cron Jobs

Add Laravel's scheduler to your crontab:

```bash
crontab -e
```

Add the following line:

```
* * * * * cd /path/to/Sabra-Music/sabra-music && php artisan schedule:run >> /dev/null 2>&1
```

## Maintenance

### Updating the Application

To update the application:

1. Pull the latest code changes:
   ```bash
   git pull origin main
   ```

2. Install any new dependencies:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   npm run prod
   ```

3. Run migrations:
   ```bash
   php artisan migrate --force
   ```

4. Clear and rebuild caches:
   ```bash
   php artisan config:clear
   php artisan config:cache
   php artisan route:clear
   php artisan route:cache
   php artisan view:clear
   php artisan view:cache
   ```

### Backup Strategy

Set up regular backups of:

1. Database
   ```bash
   mysqldump -u username -p database_name > backup.sql
   ```

2. User uploaded files
   ```bash
   php backup-uploads.php
   ```

## Troubleshooting

### Common Issues

1. **500 Server Error**
   - Check the Laravel logs in `storage/logs/laravel.log`
   - Ensure proper permissions on storage and cache directories

2. **Images Not Displaying**
   - Verify the storage symbolic link exists
   - Check file permissions in the storage directory

3. **Database Connection Errors**
   - Verify .env database settings
   - Check that the database user has proper permissions

For more assistance, refer to the [Laravel Deployment Documentation](https://laravel.com/docs/8.x/deployment).
