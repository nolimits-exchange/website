<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testNewsPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/news');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('All News - Page 1', $client->getResponse()->getContent());
    }

    public function testNewsCategoryLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/news/website');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Website News - Page 1', $client->getResponse()->getContent());
    }

    public function testNewsArticleLoads()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/news');

        $link = $crawler->selectLink('Test News')->link();

        $client->click($link);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains($link->getNode()->textContent . ' - Page 1', $client->getResponse()->getContent());
    }
}
