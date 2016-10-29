<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FaqController extends Controller
{
    /**
     * @Route("/faq", name="faq")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Faq:index.html.twig', [
            'questions' => $this->getDoctrine()->getRepository('AppBundle:Faq')->findBy([], ['order' => 'asc']),
        ]);
    }

}
