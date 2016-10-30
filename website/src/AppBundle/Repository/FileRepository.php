<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating;

class FileRepository extends EntityRepository implements SaveableInterface
{
    /**
     * Method to quickly return the rating for a given coaster.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File $file
     *
     * @return float
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getRating(File $file): float
    {
        $query = ''.
            'SELECT ' .
                'ROUND((' .
                    'IFNULL(ROUND(AVG(rating.technical), 2), 0.00) + ' .
                    'IFNULL(ROUND(AVG(rating.adrenaline), 2), 0.00) + ' .
                    'IFNULL(ROUND(AVG(rating.originality), 2), 0.00)' .
                ') / 3, 2) as total ' .
            'FROM Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating rating ' .
            'JOIN Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File file ' .
            'WHERE rating.file = :file AND rating.status IN (:statuses) ' .
            'GROUP BY rating.file';
            
        return (float) $this->_em->createQuery($query)
            ->setParameter('file', $file)
            ->setParameter('statuses', [FileRating::PUBLISHED, FileRating::REPORTED])
            ->getSingleScalarResult();
    }
    
    /**
     * Number of downloads for a coaster.
     *
     * @param File $file
     *
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getDownloads(File $file): int
    {
        $query = '' .
            'SELECT COUNT(log.id) as total ' .
            'FROM Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs log ' .
            'WHERE log.file = :file';
        
        return (int) $this->_em->createQuery($query)
            ->setParameter('file', $file)
            ->getSingleScalarResult();
    }

    /**
     * Find the highest rated files.
     *
     * @param integer      $limit
     * @param integer|null $offset
     *
     * @return array
     */
    public function findHighestWeek($limit, $offset = null)
    {
        $week = strtotime('last Sunday + 1 day');

        return $this
            ->createQueryBuilder('f')
            ->where('f.status IN (:status)')
            ->andWhere('f.dateAdded >= :week')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->setParameters([
                'status' => [File::PUBLISHED],
                'week'   => $week,
            ])
            ->orderBy('f.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the highest rated files.
     *
     * @param integer      $limit
     * @param integer|null $offset
     *
     * @return array
     */
    public function findHighestMonth($limit, $offset = null)
    {
        $month = mktime(0, 0, 0, date('n'), 1);

        return $this
            ->createQueryBuilder('f')
            ->where('f.status IN (:status)')
            ->andWhere('f.dateAdded >= :month')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->setParameters([
                'status' => [File::PUBLISHED],
                'month'   => $month,
            ])
            ->orderBy('f.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the highest rated files.
     *
     * @param integer      $limit
     * @param integer|null $offset
     *
     * @return array
     */
    public function findHighestYear($limit, $offset = null)
    {
        $year = mktime(0, 0, 0, 1, 1, date('Y'));

        return $this
            ->createQueryBuilder('f')
            ->where('f.status IN (:status)')
            ->andWhere('f.dateAdded >= :year')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->setParameters([
                'status' => [File::PUBLISHED],
                'year'   => $year,
            ])
            ->orderBy('f.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the newest uploaded files.
     *
     * @param integer      $limit
     * @param integer|null $offset
     *
     * @return array
     */
    public function findNewest($limit, $offset = null)
    {
        return $this->findBy(['status' => File::PUBLISHED], ['dateAdded' => 'desc'], $limit, $offset);
    }

    /**
     * Find the unrated files.
     *
     * @param integer      $limit
     * @param integer|null $offset
     *
     * @return array
     */
    public function findUnrated($limit, $offset = null)
    {
        return $this->findBy(['rating' => [null, 0.00], 'status' => File::PUBLISHED], [], $limit, $offset);
    }

    public function save($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }
}
