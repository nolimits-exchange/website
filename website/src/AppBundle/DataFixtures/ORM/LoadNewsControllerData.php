<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsCategory;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsContents;

/**
 * Class LoadUsersData
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\DataFixtures\ORM
 */
class LoadNewsControllerData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $parent = new NewsCategory();
        $parent->setName('All');
        $parent->setUrl('');
        $parent->setEnabled(true);
        
        $manager->persist($parent);
        
        $category = new NewsCategory();
        $category->setName('Website');
        $category->setUrl('website');
        $category->setParent($parent);
        $category->setEnabled(true);
    
        $manager->persist($category);
    
        $user = new Users();
        $user->setLastLogin(new DateTime());
        $user->setEnabled(true);
        $user->setPassword($this->getPassword($user));
        $user->setUsername('News Controller User');
        $user->setEmail('news-controller-user@example.com');
    
        $manager->persist($user);
    
        $markdown = $this->container->get('markdown.parser');
        $paragraphs = $this->container->get('faker.generator')->paragraphs(rand(3, 10));
    
        $news = new News();
        $news->setEnabled(true);
        $news->setAuthor($user);
        $news->setCategory($category);
        $news->setDateAdded($this->container->get('faker.generator')->unixTime());
        $news->setLastEdited($this->container->get('faker.generator')->unixTime());
        $news->setName('Test News ');
        $news->setUrl('test-news');
        $news->setSummary(implode(' ', $this->container->get('faker.generator')->sentences(rand(3, 4))));
    
        $manager->persist($news);
            
        $content = new NewsContents();
        $content->setName('Page');
        $content->setContent($markdown->transformMarkdown(implode("\n\n", $paragraphs)));
        $content->setArticle($news);
        $content->setOrder(1);
        
        $manager->persist($content);

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
