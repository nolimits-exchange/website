<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating;

/**
 * Class RatingCacheListener
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners
 */
class RatingCacheListener
{
    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof FileRating) {
            return;
        }

        $rating = $args->getEntityManager()
            ->getRepository('AppBundle:File')
            ->getRating($entity->getFile());

        $entity->getFile()->setRating($rating);

        $args->getEntityManager()->persist($entity);
        $args->getEntityManager()->flush();
    }
}
