<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FileRatingRepository extends EntityRepository implements SaveableInterface
{
    /**
     * @param $limit
     *
     * @return \Doctrine\ORM\Query
     */
    public function findRatingsToSpamProcess($limit)
    {
        $public   = 1;
        $reported = 2;
        
        $query = $this->_em->createQuery('' .
            'SELECT rating ' .
            'FROM Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating rating ' .
            'WHERE rating.status IN (:status) ' .
            'ORDER BY rating.dateAdded DESC '
        )->setParameter('status', [$public, $reported]);
        
        $query->setMaxResults($limit);
        
        return $query;
    }

    /**
     * @param array $ids
     * @param int   $chunkSize
     *
     * @return int
     */
    public function removeSpamRatings(array $ids, $chunkSize = 300)
    {
        $updated = 0;
        
        foreach (array_chunk($ids, $chunkSize) as $chunkedIds) {
            $query = $this->_em->createQuery('' .
                'UPDATE Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating rating ' .
                'SET rating.status = 0 ' .
                'WHERE rating.id IN (:ids)')
            ->setParameter('ids', $chunkedIds);
            
            $updated = $updated + $query->execute();
        }
        
        return $updated;
    }

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
