<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EditProfileControllerTest extends WebTestCase
{
    public function testEditProfilePageLoads()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'edit-profile-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));

        $client->request('GET', '/profile/edit');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Edit Your Profile', $client->getResponse()->getContent());
    }
}
