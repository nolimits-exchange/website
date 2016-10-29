<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoasterControllerTest extends WebTestCase
{
    public function testCoasterPageLoads()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Test Coaster')->link();

        $client->click($link);

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
        
        $crawler = $client->request('GET', '/');
    
        $link = $crawler->selectLink('Test Coaster')->link();
    
        $client->click($link);
    
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Submit a rating', $client->getResponse()->getContent());
    }
    
    public function testRatingForm()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'coaster-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));
        $client->followRedirects();
    
        $crawler = $client->request('GET', '/');
    
        $link = $crawler->selectLink('Test Coaster')->link();
    
        $crawler = $client->click($link);
    
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
}
