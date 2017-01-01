<?php
/**
 * Created by PhpStorm.
 * User: mathewdavies
 * Date: 01/01/2017
 * Time: 19:43
 */

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;

class LoadSearchControllerData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setLastLogin(new DateTime());
        $user->setEnabled(true);
        $user->setPassword($this->getPassword($user));
        $user->setUsername('Search Controller User');
        $user->setEmail('search-controller-user@example.com');
    
        $manager->persist($user);
        
        $count = 4;
        
        do {
            $form = new Upload();
            $form->setName($this->container->get('faker.generator')->firstName);
            $form->setDescription($this->container->get('faker.generator')->markdownParagraphs(random_int(1, 5)));
            $form->setCoaster($this->getCoaster());
            $form->setScreenshot($this->getScreenshot());
    
            $coaster = $this->container
                ->get('handler.coaster.upload.started')
                ->handle($form, $user);
    
            $this->container
                ->get('handler.coaster.upload.finished')
                ->handle($coaster);
            
            --$count;
        } while ($count > 0);
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
    
    /**
     * @return UploadedFile
     */
    protected function getScreenshot()
    {
        $path = $this->container->get('faker.generator')->imageGenerator(null, 1280, 1024);
        
        return new UploadedFile($path, basename($path), null, null, null, true);
    }
    
    /**
     * @return UploadedFile
     */
    protected function getCoaster()
    {
        $path = $this->container->get('faker.generator')->file(__DIR__ . '/../coasters');
        
        return new UploadedFile($path, basename($path), null, null, null, true);
    }
}
