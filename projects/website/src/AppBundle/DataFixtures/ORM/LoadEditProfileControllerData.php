<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class LoadUsersData
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM
 */
class LoadEditProfileControllerData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
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
        $user->setUsername('Edit Profile Controller User');
        $user->setEmail('edit-profile-controller-user@example.com');
        
        $manager->persist($user);
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
