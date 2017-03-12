<?php

use Symfony\Component\DependencyInjection\Container;

$secrets = json_decode(file_get_contents($_SERVER['APP_SECRETS']), true);

/**
 * @var $container Container
 */
$container->setParameter('secret', $secrets['CUSTOM']['COOKIE_SALT']);

$container->setParameter('object_storage_bucket', '%env(OBJECT_STORAGE_BUCKET)%');

$container->setParameter('locale', 'en');

$container->setParameter('debug_toolbar',   getenv('SYMFONY_ENV') === 'dev');
$container->setParameter('debug_redirects', getenv('SYMFONY_ENV') === 'dev');
