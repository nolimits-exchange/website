<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FaqControllerTest extends WebTestCase
{
    public function testFaqPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/faq');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Frequently Asked Questions', $client->getResponse()->getContent());
    }
}
