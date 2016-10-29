<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Security;

use FOS\UserBundle\Security\UserProvider;

class EmailProvider extends UserProvider
{
    /**
     * {@inheritDoc}
     */
    protected function findUser($username)
    {
        return $this->userManager->findUserByEmail($username);
    }
}
