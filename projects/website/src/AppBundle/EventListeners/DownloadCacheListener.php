<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs;

/**
 * Class DownloadCacheListener
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners
 */
class DownloadCacheListener
{
    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if (!$entity instanceof FileLogs) {
            return;
        }
        
        $downloads = $args->getEntityManager()
            ->getRepository('AppBundle:File')
            ->getDownloads($entity->getFile());
        
        $entity->getFile()->setDownloads($downloads);
        
        $args->getEntityManager()->persist($entity);
        $args->getEntityManager()->flush();
    }
}
