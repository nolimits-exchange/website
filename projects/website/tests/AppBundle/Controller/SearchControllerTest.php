<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testSearchPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/search');
    
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Search', $client->getResponse()->getContent());
    }
}
