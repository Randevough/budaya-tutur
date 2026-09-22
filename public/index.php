<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Auto-detect Laravel base path (supports Hostinger public_html structure)
$basePath = null;
if (file_exists(__DIR__ . '/../budaya-tutur/vendor/autoload.php')) {
    $basePath = __DIR__ . '/../budaya-tutur';
} elseif (file_exists(__DIR__ . '/budaya-tutur/vendor/autoload.php')) {
    $basePath = __DIR__ . '/budaya-tutur';
} elseif (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $basePath = __DIR__ . '/..';
}

if (! $basePath) {
    http_response_code(500);
    die("Configuration Error: Laravel application folder was not found.");
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $basePath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $basePath . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once $basePath . '/bootstrap/app.php';
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
