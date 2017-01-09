<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\DomCrawler\Crawler;

class CoasterControllerTest extends WebTestCase
{
    public function testCoasterPageLoads()
    {
        $client  = static::createClient();
        
        $this->getCoasterByName($client, 'Test Coaster');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Test Coaster', $client->getResponse()->getContent());
        $this->assertNotContains('Submit a rating', $client->getResponse()->getContent());
    }
    
    public function testRatingFormIsShown()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'coaster-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));
    
        $this->getCoasterByName($client, 'Test Coaster');
    
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Submit a rating', $client->getResponse()->getContent());
    }
    
    public function testRatingForm()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'coaster-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));
        
        $crawler = $this->getCoasterByName($client, 'Test Coaster');
    
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Submit a rating', $client->getResponse()->getContent());
    
        $form = $crawler->selectButton('Rate')->form();

        $comment = 'Sed nec diam ac lacus faucibus pharetra. Vestibulum a consequat orci. In ' .
            'fermentum tempus lacus. Cras a volutpat metus, et imperdiet sapien. Nunc ut facilisis urna. Morbi ' .
            'tristique nisl sed volutpat pellentesque. Nunc eget rutrum magna. Nulla luctus, dolor sit amet tempor ' .
            'hendrerit, justo lorem molestie dui, id euismod magna augue eget risus. Vivamus sit amet neque non ' .
            'mauris venenatis blandit et sed felis.';

        $form['rate[technical]']->select('2');
        $form['rate[adrenaline]']->select('4.5');
        $form['rate[originality]']->select('7');
        $form['rate[comment]']->setValue($comment);

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains($comment, $client->getResponse()->getContent());
        $this->assertContains('4.50', $client->getResponse()->getContent());
    }
    
    public function testUtf8Download()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'coaster-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));
        
        $crawler = $this->getCoasterByName($client, 'Flug der Dämonen');
    
        $this->download($client, $crawler);
    
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    
    public function testDownloadWithSlashes()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'coaster-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));
        
        $crawler = $this->getCoasterByName($client, 'Fugitive (Updated W/ Scenery)');
        
        $this->download($client, $crawler);
        
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
    
    /**
     * @param Client  $client
     * @param Crawler $crawler
     */
    protected function download(Client $client, Crawler $crawler)
    {
        $link = $crawler->selectLink('Download')->link();
    
        ob_start();
        
        $client->click($link);
    
        ob_end_clean();
    }
    
    /**
     * @param Client $client
     * @param string $name
     *
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function getCoasterByName(Client $client, string $name)
    {
        $client->followRedirects();
    
        $crawler = $client->request('GET', '/search');
    
        $form = $crawler->selectButton('Submit')->form();
        $form['term'] = $name;
    
        $crawler = $client->submit($form);
    
        $link = $crawler->selectLink($name)->link();
        
        return $client->click($link);
    }
}
