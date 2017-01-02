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
    'APP_SECRETS',
    'APP_NAME',
    'SYMFONY_ENV',
]);

return $loader;
