<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;

class ProfileController extends Controller
{
    /**
     * @Route("/user/{id}", name="profile_show")
     * @Template
     */
    public function showAction(Request $request, Users $user)
    {
        return [
            'user' => $user,
        ];
    }
}
