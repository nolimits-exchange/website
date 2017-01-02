<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChangePasswordControllerTest extends WebTestCase
{
    public function testChangePasswordPageLoads()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'change-password-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));

        $client->request('GET', '/profile/change-password');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Change Password', $client->getResponse()->getContent());
    }
}
