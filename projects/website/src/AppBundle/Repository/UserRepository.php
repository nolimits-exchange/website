<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function countUsers()
    {
        $query = $this->_em->createQuery('' .
            'SELECT COUNT(user.id) ' .
            'FROM Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users user');

        return $query->getSingleScalarResult();
    }
}
