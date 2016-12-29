<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;

/**
 * Class LoadUsersData
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM
 */
class LoadCoasterControllerData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setLastLogin(new DateTime());
        $user->setEnabled(true);
        $user->setPassword($this->getPassword($user));
        $user->setUsername('Coaster Controller User');
        $user->setEmail('coaster-controller-user@example.com');
    
        $manager->persist($user);
        
        $form = new Upload();
        $form->setName('Test Coaster');
        $form->setDescription($this->container->get('faker.generator')->markdownParagraphs(random_int(1, 5)));
        $form->setCoaster($this->getCoaster());
        $form->setScreenshot($this->getScreenshot());

        $coaster = $this->container
            ->get('handler.upload.form')
            ->handle($form, $user);
        
        $this->container
            ->get('handler.coaster.published')
            ->handle($coaster);
    }
    
    /**
     * @return UploadedFile
     */
    protected function getScreenshot()
    {
        $path = $this->container->get('faker.generator')->imageGenerator(null, 1280, 1024);
        
        return new UploadedFile($path, basename($path));
    }
    
    /**
     * @return UploadedFile
     */
    protected function getCoaster()
    {
        $path = $this->container->get('faker.generator')->file(__DIR__ . '/../coasters');
        
        return new UploadedFile($path, basename($path));
    }
    
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
