<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TermsControllerTest extends WebTestCase
{
    public function testTermsPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/terms');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Terms &amp; Conditions', $client->getResponse()->getContent());
    }
}
