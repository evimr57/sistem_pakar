<?php
define('LARAVEL_START', microtime(true));
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('view:clear');
$kernel->call('route:clear');
echo "Cache cleared!";