<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UploadControllerTest extends WebTestCase
{
    public function testUploadIsRestricted()
    {
        $client = static::createClient();
        $client->request('GET', '/upload');

        $this->assertTrue($client->getResponse()->isRedirection());
    }

    public function testUploadPageLoads()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'upload-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));

        $client->request('GET', '/upload');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Upload Your Coaster' , $client->getResponse()->getContent());
    }

    public function testUploadWorks()
    {
        $client = static::createClient([], array(
            'PHP_AUTH_USER' => 'upload-controller-user@example.com',
            'PHP_AUTH_PW'   => 'password',
        ));

        $client->followRedirects(true);

        $crawler = $client->request('GET', '/upload');

        $form = $crawler->selectButton('Upload')->form();
        $form['upload[name]']->setValue('Test File');
        $form['upload[description]']->setValue('Test description in **Markdown**');
        $form['upload[coaster]']->upload($this->getUpload('terra-phase-two/coaster.nl2pkg'));
        $form['upload[screenshot]']->upload($this->getUpload('terra-phase-two/screenshot.jpg'));

        $client->submit($form);

        $this->assertContains('Test File', $client->getResponse()->getContent());
    }

    /**
     * Get a path to a screenshot / coaster.
     *
     * @param string $path
     *
     * @return string
     */
    protected function getUpload($path)
    {
        return __DIR__ . '/../../resources/uploads/' . $path;
    }
}
