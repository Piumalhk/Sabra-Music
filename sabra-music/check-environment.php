<?php

/**
 * Sabra Music Environment Check Utility
 * 
 * This script checks if your environment meets all the requirements
 * for running the Sabra Music application.
 */

echo PHP_EOL;
echo "╔═══════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║          Sabra Music Environment Check                    ║" . PHP_EOL;
echo "╚═══════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;

// Function to check if a PHP extension is loaded
function checkExtension($extension, $required = true) {
    if (extension_loaded($extension)) {
        echo "✅ PHP Extension: $extension" . PHP_EOL;
        return true;
    } else {
        $status = $required ? "❌" : "⚠️";
        $message = $required ? "Required" : "Recommended";
        echo "$status PHP Extension: $extension ($message)" . PHP_EOL;
        return false;
    }
}

// Function to check PHP version
function checkPhpVersion($minVersion = '7.3.0') {
    $currentVersion = phpversion();
    $versionOk = version_compare($currentVersion, $minVersion, '>=');
    
    echo ($versionOk ? "✅" : "❌") . " PHP Version: $currentVersion";
    echo " (Minimum required: $minVersion)" . PHP_EOL;
    
    return $versionOk;
}

// Function to check directory permissions
function checkDirectoryPermissions($path) {
    if (!file_exists($path)) {
        echo "❌ Directory not found: $path" . PHP_EOL;
        return false;
    }
    
    $writable = is_writable($path);
    echo ($writable ? "✅" : "❌") . " Directory permissions: $path" . 
         ($writable ? " (Writable)" : " (Not writable)") . PHP_EOL;
    
    return $writable;
}

// Function to check if a command exists
function commandExists($command) {
    $whereIsCommand = (PHP_OS == 'WINNT') ? "where" : "which";
    $process = proc_open(
        "$whereIsCommand $command",
        [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"],
        ],
        $pipes
    );
    
    if ($process !== false) {
        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);
        
        return $stdout != '';
    }
    
    return false;
}

// Check environment
echo "📋 Checking PHP environment..." . PHP_EOL;
$phpOk = checkPhpVersion('7.3.0');

echo PHP_EOL . "📋 Checking required PHP extensions..." . PHP_EOL;
$extensions = [
    'BCMath',
    'Ctype',
    'Fileinfo',
    'JSON',
    'Mbstring',
    'OpenSSL',
    'PDO',
    'Tokenizer',
    'XML'
];

$missingExt = false;
foreach ($extensions as $ext) {
    if (!checkExtension($ext)) {
        $missingExt = true;
    }
}

echo PHP_EOL . "📋 Checking recommended PHP extensions..." . PHP_EOL;
checkExtension('GD', false);
checkExtension('Zip', false);
checkExtension('intl', false);

echo PHP_EOL . "📋 Checking directory permissions..." . PHP_EOL;
$dirOk = true;
$dirsToCheck = [
    __DIR__ . '/storage',
    __DIR__ . '/storage/app',
    __DIR__ . '/storage/app/public',
    __DIR__ . '/storage/framework',
    __DIR__ . '/storage/logs',
    __DIR__ . '/bootstrap/cache'
];

foreach ($dirsToCheck as $dir) {
    if (!checkDirectoryPermissions($dir)) {
        $dirOk = false;
    }
}

echo PHP_EOL . "📋 Checking available commands..." . PHP_EOL;
$commands = [
    'composer' => false,
    'npm' => false,
    'node' => false,
    'git' => false
];

foreach ($commands as $cmd => $required) {
    $exists = commandExists($cmd);
    $status = $exists ? "✅" : ($required ? "❌" : "⚠️");
    $message = $required ? "Required" : "Recommended";
    echo "$status Command: $cmd " . ($exists ? "(Available)" : "($message but not found)") . PHP_EOL;
}

// Check storage symlink
echo PHP_EOL . "📋 Checking storage symbolic link..." . PHP_EOL;
$storageLink = __DIR__ . '/public/storage';
$linkTarget = __DIR__ . '/storage/app/public';

if (file_exists($storageLink)) {
    $isSymlink = is_link($storageLink) || (PHP_OS == 'WINNT' && is_dir($storageLink));
    
    if ($isSymlink) {
        echo "✅ Storage symbolic link exists" . PHP_EOL;
    } else {
        echo "⚠️ Storage link exists but is not a symbolic link" . PHP_EOL;
    }
} else {
    echo "❌ Storage symbolic link does not exist. Run 'php artisan storage:link'" . PHP_EOL;
}

// Summary
echo PHP_EOL;
echo "╔═══════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║                 Environment Check Summary                 ║" . PHP_EOL;
echo "╚═══════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;

if ($phpOk && !$missingExt && $dirOk) {
    echo "🎉 Your environment meets all the requirements for Sabra Music!" . PHP_EOL;
} else {
    echo "⚠️ Some requirements are not met. Please fix the issues above." . PHP_EOL;
}

echo PHP_EOL;
echo "📋 Next steps:" . PHP_EOL;
echo "  1. Ensure your .env file is properly configured" . PHP_EOL;
echo "  2. Run migrations: php artisan migrate" . PHP_EOL;
echo "  3. Start the development server: php artisan serve" . PHP_EOL;
echo PHP_EOL;
