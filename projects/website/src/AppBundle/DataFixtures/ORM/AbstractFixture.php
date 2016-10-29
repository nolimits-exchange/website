<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture as DoctrineFixture;

/**
 * Class AbstractFixture
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM
 */
abstract class AbstractFixture extends DoctrineFixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * Generate a password, once ...
     *
     * @param Users $user
     *
     * @return string
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function getPassword(Users $user): string
    {
        static $password = null;
        
        if ($password === null) {
            $faker    = $this->container->get('faker.generator');
            $password = $faker->password($user, 'password', 'salt');
        }
        
        return $password;
    }
}
