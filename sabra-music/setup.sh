#!/bin/bash

echo "Sabra Music Setup Utility"
echo "========================="
echo ""
echo "This script will help you set up the Sabra Music application."
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "PHP not found. Please make sure PHP is installed and in your PATH."
    echo ""
    echo "Press any key to exit..."
    read -n 1
    exit 1
fi

echo "1. Running environment check..."
php check-environment.php
echo ""

echo "2. Running setup script..."
php setup.php
echo ""

echo "3. Checking if Composer is installed..."
if ! command -v composer &> /dev/null; then
    echo "Composer not found in PATH. Please install Composer dependencies manually."
    echo "Run: composer install"
else
    echo "Composer found. Do you want to install PHP dependencies now? (y/n)"
    read -n 1 -r
    echo ""
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        echo "Running: composer install"
        composer install
    else
        echo "Skipping dependency installation."
    fi
fi
echo ""

echo "4. Checking if NPM is installed..."
if ! command -v npm &> /dev/null; then
    echo "NPM not found in PATH. Please install NPM dependencies manually."
    echo "Run: npm install && npm run dev"
else
    echo "NPM found. Do you want to install NPM dependencies now? (y/n)"
    read -n 1 -r
    echo ""
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        echo "Running: npm install && npm run dev"
        npm install
        npm run dev
    else
        echo "Skipping dependency installation."
    fi
fi
echo ""

echo "5. Do you want to start the development server now? (y/n)"
read -n 1 -r
echo ""
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "Starting development server..."
    echo "Running: php artisan serve"
    php artisan serve
else
    echo "Skipping server start."
fi
echo ""

echo "Setup process completed."
echo "To start the server manually, run: php artisan serve"
echo ""
echo "Press any key to exit..."
read -n 1
