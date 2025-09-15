<?php

/**
 * Sabra Music Backup Utility
 * 
 * This script creates a backup of uploaded files from the storage directory.
 * Use this script before migrating to a new system to ensure all user uploads are preserved.
 */

echo PHP_EOL;
echo "╔═══════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║          Sabra Music Backup Utility                       ║" . PHP_EOL;
echo "╚═══════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;

// Set backup directory
$backupDir = __DIR__ . '/backup_' . date('Y-m-d_H-i-s');
$storageDir = __DIR__ . '/storage/app/public';

// Directories to backup
$directoriesToBackup = [
    'events',
    'pdf'
];

// Create backup directory
if (!file_exists($backupDir)) {
    if (mkdir($backupDir, 0755, true)) {
        echo "✅ Created backup directory: " . basename($backupDir) . PHP_EOL;
    } else {
        echo "❌ Failed to create backup directory. Aborting." . PHP_EOL;
        exit(1);
    }
}

// Function to recursively copy directories
function copyDirectory($source, $destination) {
    if (!is_dir($source)) {
        echo "⚠️ Source directory does not exist: $source" . PHP_EOL;
        return false;
    }
    
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    $fileCount = 0;
    $dir = opendir($source);
    
    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            $srcFile = $source . '/' . $file;
            $destFile = $destination . '/' . $file;
            
            if (is_dir($srcFile)) {
                copyDirectory($srcFile, $destFile);
            } else {
                if (copy($srcFile, $destFile)) {
                    $fileCount++;
                } else {
                    echo "❌ Failed to copy file: $srcFile" . PHP_EOL;
                }
            }
        }
    }
    
    closedir($dir);
    return $fileCount;
}

// Backup each directory
$totalFiles = 0;

foreach ($directoriesToBackup as $dir) {
    $source = $storageDir . '/' . $dir;
    $destination = $backupDir . '/' . $dir;
    
    echo "📂 Backing up $dir..." . PHP_EOL;
    
    if (is_dir($source)) {
        $fileCount = copyDirectory($source, $destination);
        if ($fileCount !== false) {
            echo "✅ Backed up $fileCount files from $dir directory" . PHP_EOL;
            $totalFiles += $fileCount;
        }
    } else {
        echo "⚠️ Directory not found: $dir (skipping)" . PHP_EOL;
    }
}

// Create a restoration script
$restoreScript = <<<EOT
<?php
/**
 * Sabra Music Restore Script
 * 
 * This script restores backed up files to the storage directory.
 */

echo PHP_EOL;
echo "╔═══════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║          Sabra Music Restore Utility                      ║" . PHP_EOL;
echo "╚═══════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;

// Paths
\$backupDir = __DIR__;
\$storageDir = __DIR__ . '/../storage/app/public';

// Directories to restore
\$directoriesToRestore = [
    'events',
    'pdf'
];

// Function to recursively copy directories
function copyDirectory(\$source, \$destination) {
    if (!is_dir(\$source)) {
        echo "⚠️ Source directory does not exist: \$source" . PHP_EOL;
        return false;
    }
    
    if (!is_dir(\$destination)) {
        mkdir(\$destination, 0755, true);
    }
    
    \$fileCount = 0;
    \$dir = opendir(\$source);
    
    while ((\$file = readdir(\$dir)) !== false) {
        if (\$file != '.' && \$file != '..') {
            \$srcFile = \$source . '/' . \$file;
            \$destFile = \$destination . '/' . \$file;
            
            if (is_dir(\$srcFile)) {
                copyDirectory(\$srcFile, \$destFile);
            } else {
                if (copy(\$srcFile, \$destFile)) {
                    \$fileCount++;
                } else {
                    echo "❌ Failed to copy file: \$srcFile" . PHP_EOL;
                }
            }
        }
    }
    
    closedir(\$dir);
    return \$fileCount;
}

// Restore each directory
\$totalFiles = 0;

foreach (\$directoriesToRestore as \$dir) {
    \$source = \$backupDir . '/' . \$dir;
    \$destination = \$storageDir . '/' . \$dir;
    
    echo "📂 Restoring \$dir..." . PHP_EOL;
    
    if (is_dir(\$source)) {
        \$fileCount = copyDirectory(\$source, \$destination);
        if (\$fileCount !== false) {
            echo "✅ Restored \$fileCount files to \$dir directory" . PHP_EOL;
            \$totalFiles += \$fileCount;
        }
    } else {
        echo "⚠️ Directory not found: \$dir (skipping)" . PHP_EOL;
    }
}

echo PHP_EOL;
echo "🎉 Restoration complete! Restored \$totalFiles files." . PHP_EOL;
echo "✨ Remember to run 'php artisan storage:link' if you haven't already." . PHP_EOL;
echo PHP_EOL;
EOT;

// Save restore script to backup directory
file_put_contents($backupDir . '/restore.php', $restoreScript);

echo PHP_EOL;
echo "🎉 Backup complete! Backed up $totalFiles files to " . basename($backupDir) . " directory." . PHP_EOL;
echo "📋 Instructions for restoring the backup:" . PHP_EOL;
echo "  1. Copy the entire backup directory to your new installation" . PHP_EOL;
echo "  2. Navigate to the backup directory" . PHP_EOL;
echo "  3. Run 'php restore.php'" . PHP_EOL;
echo "  4. Run 'php artisan storage:link' to ensure the storage link is created" . PHP_EOL;
echo PHP_EOL;
