<?php

use Symfony\Component\Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load( __DIR__ . '/.env.test.dist');
if (file_exists(__DIR__ . '/.env.test')) {
    $dotenv->overload( __DIR__ . '/.env.test');
}