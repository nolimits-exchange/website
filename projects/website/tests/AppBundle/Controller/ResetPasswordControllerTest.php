<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{
    public function testResetPasswordPageLoads()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'reset-password-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));

        $client->request('GET', '/resetting/request');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Forgotten password', $client->getResponse()->getContent());
    }
}
