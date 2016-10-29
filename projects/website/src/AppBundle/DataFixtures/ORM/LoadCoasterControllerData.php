<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
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
        
        $file = new File();
        $file->setName('Test Coaster');
        $file->setStatus(File::PUBLISHED);
        $file->setAuthor($user);
        $file->setDescription($this->container->get('faker.generator')->markdownParagraphs(random_int(1, 5)));
        $file->setStyle($this->getReference('style-1'));
        $file->setCoasterExt('nlpack');
        $file->setScreenshotExt('png');
        
        $manager->persist($file);
        $manager->flush();
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
