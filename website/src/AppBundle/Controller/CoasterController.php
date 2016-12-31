<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Rate;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\RateType;

/**
 * Class CoasterController
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller
 */
class CoasterController extends Controller
{
    /**
     * @Route("/coaster/{slug}/{id}", name="coaster")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $coaster = $this->getDoctrine()->getRepository('AppBundle:File')->findOneBy([
            'id'     => $request->get('id'),
            'status' => [File::UPLOADING, File::PUBLISHED]
        ]);

        if (!$coaster) {
            throw $this->createNotFoundException();
        }
        
        $rate = new Rate();
        
        $ratingForm = $this->createForm(RateType::class, $rate);
        $ratingForm->handleRequest($request);
        
        if ($ratingForm->isSubmitted() && $ratingForm->isValid()) {
            $rating = new FileRating();
            $rating->setTechnical($rate->getTechnical());
            $rating->setAdrenaline($rate->getAdrenaline());
            $rating->setOriginality($rate->getOriginality());
            $rating->setComment($rate->getComment());
            $rating->setUser($this->getUser());
            $rating->setStatus(FileRating::PUBLISHED);
            $rating->setFile($coaster);
        
            $this->getDoctrine()->getRepository('AppBundle:FileRating')->save($rating);
        
            return $this->redirectToRoute('coaster', [
                'id'   => $coaster->getId(),
                'slug' => $this->get('slugify')->slugify($coaster->getName()),
            ]);
        }
        
        return $this->render('AppBundle:Coaster:index.html.twig', [
            'coaster'    => $coaster,
            'rated'      => $coaster->getRatings()->contains($this->getUser()),
            'downloaded' => $coaster->getDownloadLog()->contains($this->getUser()),
            'ratingForm' => $ratingForm->createView(),
        ]);
    }

    /**
     * @Route("/coaster/{slug}/{id}/download", name="coaster_download")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request  $request
     *
     * @return Response
     *
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function downloadAction(Request $request)
    {
        $coaster = $this->getDoctrine()->getRepository('AppBundle:File')->findOneBy([
            'id'     => $request->get('id'),
            'status' => [File::PUBLISHED]
        ]);

        if (!$coaster) {
            throw $this->createNotFoundException();
        }
        
        $log = new FileLogs();
        $log->setUser($this->getUser());
        $log->setFile($coaster);
        
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($log);
        $manager->flush();

        $filesystem  = $this->get('oneup_flysystem.coasters_filesystem');
        $coasterUtil = $this->get('util.coaster');
        
        $coasterFile = $filesystem->get(
            $coasterUtil->getCoasterPath(
                $coaster->getId(),
                $coaster->getCoasterExt()
            )
        );
        
        $response = new Response();
        
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $coaster->getFilename()
        );
        
        $response->headers->set('Content-Disposition', $disposition);
        $response->setContent($coasterFile->read());
        
        return $response;
    }
}
