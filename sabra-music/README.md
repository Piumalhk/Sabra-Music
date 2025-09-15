# Sabra Music - Event Booking Platform

![Sabra Music](public/images/Group-237.png)

## Overview
Sabra Music is a platform for booking musical venues and events at the art center.

## Features
- Event scheduling and management
- Booking system for users
- Admin panel for event and booking management
- PDF attachment support for booking details
- Image upload for events

## Installation

### Prerequisites
- PHP 7.3 or higher
- Composer
- MySQL or another database supported by Laravel
- Node.js and NPM (for frontend assets)

### Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/Piumalhk/Sabra-Music.git
cd Sabra-Music/sabra-music
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install && npm run dev
```

4. Run the setup script:
```bash
php setup.php
```

This script will:
- Create an .env file (if needed)
- Create the storage symbolic link (crucial for images and PDFs)
- Set proper permissions on storage directories
- Create necessary directories for uploads

5. Configure your database in the .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sabra_music
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations and seed the database:
```bash
php artisan migrate --seed
```

7. Start the development server:
```bash
php artisan serve
```

### Troubleshooting Common Issues

#### Images and PDFs Not Displaying

If images or PDFs are not displaying after cloning the project:

1. Make sure the storage link is created:
```bash
php artisan storage:link
```

2. Check that the storage directory has the correct permissions:
```bash
# On Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# On Windows PowerShell
icacls storage /grant Everyone:F /T
icacls bootstrap/cache /grant Everyone:F /T
```

3. For existing projects, you need to copy the uploaded files from the original installation to the new one:
   - Event images go to: `storage/app/public/events`
   - PDF attachments go to: `storage/app/public/pdf`

#### Missing .env File

If you don't have an .env file, create one from .env.example:
```bash
cp .env.example .env
php artisan key:generate
```

## Usage

### User Access
- Visit `/` for the homepage
- Visit `/schedule` for event scheduling
- Visit `/booking` to create a booking (requires login)

### Admin Access
- Visit `/adminlogin` for admin login
- Default admin credentials:
  - Email: admin@example.com
  - Password: password

## Deployment Notes

When deploying to production:

1. Make sure to set the appropriate environment variables in .env
2. Optimize the application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. Ensure the web server has write permissions to the storage and bootstrap/cache directories

## License

This project is licensed under the MIT License - see the LICENSE file for details.
