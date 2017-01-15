<?php

use Symfony\Component\DependencyInjection\Container;

$secrets = json_decode(file_get_contents($_SERVER['APP_SECRETS']), true);

/**
 * @var $container Container
 */

$container->setParameter('database_driver', 'pdo_mysql'); 
$container->setParameter('database_host',     $secrets['MYSQL']['HOST']);
$container->setParameter('database_port',     $secrets['MYSQL']['PORT']);
$container->setParameter('database_name',     $secrets['MYSQL']['DATABASE']);
$container->setParameter('database_user',     $secrets['MYSQL']['USER']);
$container->setParameter('database_password', $secrets['MYSQL']['PASSWORD']);

$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host',     $secrets['CUSTOM']['EMAIL_HOST']);
$container->setParameter('mailer_port',     $secrets['CUSTOM']['EMAIL_PORT']);
$container->setParameter('mailer_user',     $secrets['CUSTOM']['EMAIL_USER']);
$container->setParameter('mailer_password', $secrets['CUSTOM']['EMAIL_PASS']);

$container->setParameter('object_storage_bucket', $secrets['OBJECT_STORAGE']['BUCKET']);
$container->setParameter('object_storage_host',   $secrets['OBJECT_STORAGE']['HOST']);
$container->setParameter('object_storage_key',    $secrets['OBJECT_STORAGE']['KEY']);
$container->setParameter('object_storage_region', $secrets['OBJECT_STORAGE']['REGION']);
$container->setParameter('object_storage_secret', $secrets['OBJECT_STORAGE']['SECRET']);
$container->setParameter('object_storage_server', $secrets['OBJECT_STORAGE']['SERVER']);

$container->setParameter('secret', $secrets['CUSTOM']['COOKIE_SALT']);

$container->setParameter('locale', 'en');

$container->setParameter('debug_toolbar',   getenv('SYMFONY_ENV') === 'dev');
$container->setParameter('debug_redirects', getenv('SYMFONY_ENV') === 'dev');
