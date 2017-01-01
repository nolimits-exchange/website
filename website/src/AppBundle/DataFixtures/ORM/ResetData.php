<?php
/**
 * Created by PhpStorm.
 * User: mathewdavies
 * Date: 01/01/2017
 * Time: 20:07
 */

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use League\Flysystem\FilesystemInterface;

class ResetData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->removeFiles($this->container->get('oneup_flysystem.ephemeral_filesystem'));
        $this->removeFiles($this->container->get('oneup_flysystem.coasters_filesystem'));
        $this->removeFiles($this->container->get('oneup_flysystem.screenshots_filesystem'));
    }
    
    /**
     * @param FilesystemInterface $filesystem
     *
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \League\Flysystem\RootViolationException
     */
    protected function removeFiles(FilesystemInterface $filesystem)
    {
        foreach ($filesystem->listContents('', true) as $file) {
            if ($file['type'] === 'dir') {
                $filesystem->deleteDir($file['path']);
            }
        }
    }
    
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return -1;
    }
}
