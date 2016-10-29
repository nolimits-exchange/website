<?php

namespace Tests\AppBundle\Controller;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector;

class ContactControllerTest extends WebTestCase
{
    public function testContactPageLoads()
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Contact Us', $client->getResponse()->getContent());
    }

    public function testFormSubmission()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $client->enableProfiler();

        $form = $crawler->selectButton('Send')->form();

        $form['form[name]']->setValue('Test User');
        $form['form[email]']->setValue('mail@example.com');
        $form['form[reason]']->select('advertising');
        $form['form[message]']->setValue('Test Message');

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Thank You', $client->getResponse()->getContent());

        /** @var MessageDataCollector $mailCollector */
        $mailCollector = $client->getProfile()->getCollector('swiftmailer');
        $collectedMessages = $mailCollector->getMessages();

        /** @var Swift_Message $message */
        $message = $collectedMessages[0];

        // Asserting email data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertEquals('Contact - Advertising', $message->getSubject());
        $this->assertEquals('mail@example.com', key($message->getReplyTo()));
        $this->assertContains('Test Message', $message->getBody());
    }
}
