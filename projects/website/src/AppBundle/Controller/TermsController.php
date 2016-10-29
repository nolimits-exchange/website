<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TermsController extends Controller
{
    /**
     * @Route("/terms", name="terms")
     * @Cache(expires="tomorrow", public=true)
     * @Template
     */
    public function indexAction()
    {
        return ['title' => $this->get('translator')->trans('Terms and Conditions')];
    }
}
