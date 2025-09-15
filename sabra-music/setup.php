#!/usr/bin/env php
<?php

// Post-installation setup script for Sabra-Music
echo "\n";
echo "📋 Sabra-Music Setup Helper\n";
echo "==========================\n\n";

// Check if .env file exists
if (!file_exists(__DIR__ . '/.env')) {
    echo "⚠️  .env file not found.\n";
    echo "✅ Creating .env file from .env.example...\n";
    
    if (file_exists(__DIR__ . '/.env.example')) {
        copy(__DIR__ . '/.env.example', __DIR__ . '/.env');
        echo "   .env file created successfully!\n\n";
    } else {
        echo "❌ .env.example file not found. Please create a .env file manually.\n\n";
    }
} else {
    echo "✅ .env file already exists.\n\n";
}

// Create storage link
echo "📁 Creating storage link...\n";
echo "   This will make uploaded files accessible from the web.\n";
echo "   Running: php artisan storage:link\n";

$output = shell_exec('php artisan storage:link 2>&1');
echo "   " . ($output ? $output : "Storage link created successfully!") . "\n\n";

// Set storage permissions
echo "🔒 Setting storage directory permissions...\n";
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    // Windows permissions
    echo "   Windows system detected. Please ensure your web server has write access to the storage directory.\n\n";
} else {
    // Unix permissions
    echo "   Running: chmod -R 775 storage bootstrap/cache\n";
    shell_exec('chmod -R 775 storage');
    shell_exec('chmod -R 775 bootstrap/cache');
    echo "   Permissions set successfully!\n\n";
}

// Check for uploads directory
if (!is_dir(__DIR__ . '/storage/app/public/events')) {
    echo "📁 Creating directory for event images...\n";
    mkdir(__DIR__ . '/storage/app/public/events', 0775, true);
    echo "   Directory created successfully!\n\n";
} else {
    echo "✅ Event images directory already exists.\n\n";
}

// Provide additional instructions
echo "📝 Additional steps:\n";
echo "   1. If you're missing uploaded files (images, PDFs), copy them to the appropriate directories:\n";
echo "      - Event images: storage/app/public/events\n";
echo "      - PDF attachments: storage/app/public/pdf\n\n";
echo "   2. Run database migrations and seed:\n";
echo "      php artisan migrate --seed\n\n";

echo "✨ Setup complete! Your Sabra-Music application should now be ready to use.\n";
echo "   If you're still having issues, please refer to the troubleshooting section in the README.md file.\n";
