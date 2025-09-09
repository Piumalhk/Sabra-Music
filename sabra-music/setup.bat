@echo off
echo Sabra Music Setup Utility
echo ========================
echo.
echo This script will help you set up the Sabra Music application.
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

echo 1. Running environment check...
php check-environment.php
echo.

echo 2. Running setup script...
php setup.php
echo.

echo 3. Checking if Composer is installed...
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo Composer not found in PATH. Please install Composer dependencies manually.
    echo Run: composer install
) else (
    echo Composer found. Do you want to install PHP dependencies now? (Y/N)
    choice /C YN /M "Install dependencies now"
    if %ERRORLEVEL% EQU 1 (
        echo Running: composer install
        composer install
    ) else (
        echo Skipping dependency installation.
    )
)
echo.

echo 4. Checking if NPM is installed...
where npm >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo NPM not found in PATH. Please install NPM dependencies manually.
    echo Run: npm install ^&^& npm run dev
) else (
    echo NPM found. Do you want to install NPM dependencies now? (Y/N)
    choice /C YN /M "Install dependencies now"
    if %ERRORLEVEL% EQU 1 (
        echo Running: npm install ^& npm run dev
        npm install
        npm run dev
    ) else (
        echo Skipping dependency installation.
    )
)
echo.

echo 5. Do you want to start the development server now? (Y/N)
choice /C YN /M "Start development server"
if %ERRORLEVEL% EQU 1 (
    echo Starting development server...
    echo Running: php artisan serve
    php artisan serve
) else (
    echo Skipping server start.
)
echo.

echo Setup process completed.
echo To start the server manually, run: php artisan serve
echo.
echo Press any key to exit...
pause >nul
