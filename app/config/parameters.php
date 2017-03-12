<?php

use Symfony\Component\DependencyInjection\Container;

$secrets = json_decode(file_get_contents($_SERVER['APP_SECRETS']), true);

/**
 * @var $container Container
 */
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host',     $secrets['CUSTOM']['EMAIL_HOST']);
$container->setParameter('mailer_port',     $secrets['CUSTOM']['EMAIL_PORT']);
$container->setParameter('mailer_user',     $secrets['CUSTOM']['EMAIL_USER']);
$container->setParameter('mailer_password', $secrets['CUSTOM']['EMAIL_PASS']);

$container->setParameter('secret', $secrets['CUSTOM']['COOKIE_SALT']);

$container->setParameter('locale', 'en');

$container->setParameter('debug_toolbar',   getenv('SYMFONY_ENV') === 'dev');
$container->setParameter('debug_redirects', getenv('SYMFONY_ENV') === 'dev');
