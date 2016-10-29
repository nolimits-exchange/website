<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WelcomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Welcome:index.html.twig', [
            'files' => [
                'highest' => [
                    'week'  => $this->getDoctrine()->getRepository('AppBundle:File')->findHighestWeek(5),
                    'month' => $this->getDoctrine()->getRepository('AppBundle:File')->findHighestMonth(5),
                    'year'  => $this->getDoctrine()->getRepository('AppBundle:File')->findHighestYear(5),
                ],
                'newest'  => $this->getDoctrine()->getRepository('AppBundle:File')->findNewest(5),
            ],
            'articles' => $this->getDoctrine()->getRepository('AppBundle:News')->findNewest(5),
        ]);
    }

}
