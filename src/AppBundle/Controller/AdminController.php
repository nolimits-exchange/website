<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Edit;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\EditType;
use UnexpectedValueException;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Rate;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\RateType;


/**
 * Class CoasterController
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $articles = $this->get('doctrine')->getRepository('AppBundle:News')->findAll();

        return [
            'articles' => $articles,
        ];
    }
}
