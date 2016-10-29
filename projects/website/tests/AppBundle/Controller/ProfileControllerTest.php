<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testProfileIsRestricted()
    {
        $client = static::createClient();
        $client->request('GET', '/profile');

        $this->assertTrue($client->getResponse()->isRedirection());
    }
}
