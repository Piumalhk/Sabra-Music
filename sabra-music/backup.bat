@echo off
echo Sabra Music Backup Utility
echo ===========================
echo.
echo This script will backup all uploaded files from the storage directory.
echo.

REM Check if PHP is in the PATH
where php >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo PHP not found in PATH. Please make sure PHP is installed and in your PATH.
    echo.
    echo Press any key to exit...
    pause >nul
    exit /b 1
)

echo Running backup script...
echo.
php backup-uploads.php

echo.
echo Press any key to exit...
pause >nul
