<?php
$targetPath = __DIR__ . '/storage/app/public';
$linkPath = __DIR__ . '/public/storage';

if (!file_exists($linkPath)) {
    symlink($targetPath, $linkPath);
    echo "Storage link created!";
} else {
    echo "Storage link already exists!";
}