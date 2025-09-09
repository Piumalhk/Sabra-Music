#!/bin/bash

echo "Sabra Music Backup Utility"
echo "==========================="
echo ""
echo "This script will backup all uploaded files from the storage directory."
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "PHP not found. Please make sure PHP is installed and in your PATH."
    echo ""
    echo "Press any key to exit..."
    read -n 1
    exit 1
fi

echo "Running backup script..."
echo ""
php backup-uploads.php

echo ""
echo "Press any key to exit..."
read -n 1
