<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;

interface SaveableInterface extends ObjectRepository
{
    public function save($entity);
}
