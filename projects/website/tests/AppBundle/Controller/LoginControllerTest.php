<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLoginPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Login', $client->getResponse()->getContent());
    }

    public function testLoginPageSubmits()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Log in')->form();

        $form['_username']->setValue('login-controller-user@example.com');
        $form['_password']->setValue('password');

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Logged in as Login Controller User', $client->getResponse()->getContent());
    }
}
