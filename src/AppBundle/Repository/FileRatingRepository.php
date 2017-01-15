<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FileRatingRepository extends EntityRepository implements SaveableInterface
{
    /**
     * @param $status
     * @return int
     */
    protected function count($status)
    {
        $query = $this->_em->createQuery('' .
            'SELECT COUNT(rating.id) ' .
            'FROM Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating rating ' .
            'WHERE rating.status IN (:status)')
        ->setParameter('status', $status);

        return $query->getSingleScalarResult();
    }

    /**
     * @return int
     */
    public function countPublished()
    {
        return $this->count(1);
    }

    /**
     * @param $entity
     */
    public function detach($entity)
    {
        $this->_em->detach($entity);
    }

    /**
     * @param $entity
     */
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush($entity);
    }
}
