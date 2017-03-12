<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;
use Dotenv\Dotenv;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$dotenvFile = new SplFileInfo(__DIR__ . '/../.env');

$dotenv = new Dotenv(__DIR__ . '/../');

try {
    $dotenv->load();
} catch (Exception $e) {
    // .env file doesn't exist, assume
    // we're loading from the environment.
}

$dotenv->required([
    'APP_NAME',
    'APP_SECRET',
    
    'SYMFONY_ENV',

    'MYSQL_DATABASE',
    'MYSQL_HOST',
    'MYSQL_PASSWORD',
    'MYSQL_PORT',
    'MYSQL_USER',
    
    'OBJECT_STORAGE_BUCKET',
    'OBJECT_STORAGE_KEY',
    'OBJECT_STORAGE_REGION',
    'OBJECT_STORAGE_SECRET',
    'OBJECT_STORAGE_SERVER',
    
    'EMAIL_HOST',
    'EMAIL_PASS',
    'EMAIL_PORT',
    'EMAIL_USER',
]);

return $loader;
