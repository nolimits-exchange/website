<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsContents;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170108121842 extends AbstractMigration implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    
    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $objectManager = $this->container->get('doctrine')->getManager();
        
        $markdown = $this->container->get('templating.helper.markdown');
        
        $author   = $objectManager->getRepository('AppBundle:Users')->findOneBy(['id' => 8]);
        $category = $objectManager->getRepository('AppBundle:NewsCategory')->findOneBy(['url' => 'website']);
        
        if ($author && $category) {
            $news = new News();
            $news->setAuthor($author);
            $news->setCategory($category);
            $news->setUrl('new-and-improved');
            $news->setDateAdded(time());
            $news->setLastEdited(time());
            $news->setEnabled(true);
            $news->setHits(0);
            $news->setUniqueHits(0);
            $news->setSummary('It\'s been a long time coming, but we\'ve managed to deliver on some of what we spoke about in the last blog post.');
            $news->setName('New and Improved');
            
            $objectManager->persist($news);
            
            $newsContents = new NewsContents();
            $newsContents->setName('Page 1');
            $newsContents->setArticle($news);
            $newsContents->setContent($markdown->transform(<<<MARKDOWN
    So first of all I'd like to apologise for the delays and broken functionality. This is fixed now, so if you've
    been having trouble registering an account, please try again. If you're still in trouble, use the [contact form](/contact) to get
    in touch and I'll sort this for you as soon as possible.
    
    
    Features
    --------
    
    1. **Open Sourced**: If you're a programmer. Then the code behind this website is now [open source](https://github.com/nolimits-exchange) on GitHub.
    2. **Mobile Enabled**: Should now be fit for use on everything from an iPhone, iPad and everything else.
    
    Improvements
    ------------
    
    1. **Search**: Code behind search has been revamped. No delay in things appearing, improved performance, etc ...
    2. **Nolimits 1**: Old _old_ files are no longer supported. Licensing meant I wasn't allowed to open source this.
    
    Fixes
    -----
    
    1. Emails are now working again.
    
    ---
    
    I've got a few more things to work on and bring back, which I'll be working on. Expect more updates soon.
MARKDOWN
    ));
            $newsContents->setOrder(0);
            
            $objectManager->persist($newsContents);
            $objectManager->flush();
        }
        
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    
    }
}
