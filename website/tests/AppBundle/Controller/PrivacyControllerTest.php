<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrivacyControllerTest extends WebTestCase
{
    public function testPrivacyPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/privacy');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Privacy Policy', $client->getResponse()->getContent());
    }
}
