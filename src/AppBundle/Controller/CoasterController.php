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
            'rated'      => $coaster->isRatedByUser($this->getUser()),
            'downloaded' => $coaster->isDownloadedByUser($this->getUser()),
            'ratingForm' => $ratingForm->createView(),
        ]);
    }

    /**
     * @Route("/coaster/{slug}/{id}/edit", name="coaster_edit")
     * @param Request $request
     * @Template
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Request $request)
    {
        $file = $this->getDoctrine()->getRepository('AppBundle:File')->findOneBy([
            'id'     => $request->get('id'),
            'status' => [File::UPLOADING, File::PUBLISHED],
            'author' => $this->getUser(),
        ]);

        if (!$file) {
            throw $this->createNotFoundException();
        }

        $upload = new Edit();
        $upload->setDescription($file->getDescription());
        $upload->setName($file->getName());

        $form = $this->createForm(EditType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file->setName($form->getData()->getName());
            $file->setDescription($form->getData()->getDescription());

            $this->get('doctrine')
                ->getRepository('AppBundle:File')
                ->save($file);

            return $this->redirectToRoute('coaster_edit', [
                'id'   => $file->getId(),
                'slug' => $this->get('slugify')->slugify($file->getName()),
            ]);
        }

        return [
            'form'    => $form->createView(),
            'coaster' => $file,
        ];
    }
    
    /**
     * @Route("/coaster/{slug}/{id}/download", name="coaster_download")
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     *
     * @return Response
     * @throws HttpException
     *
     * @throws UnexpectedValueException
     * @throws InvalidArgumentException
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
        $slugify     = $this->get('slugify');
    
        
        $paths = [
            $coasterUtil->getCoasterPath(
                $coaster->getId(),
                $coaster->getCoasterExt()
            ),
            sprintf('/coasters/%s.%s',
                $slugify->slugify($coaster->getName()),
                $coaster->getCoasterExt()
            )
        ];
        
        foreach ($paths as $path) {
            if ($filesystem->has($path)) {
                /**
                 * @var \League\Flysystem\File $coasterFile
                 */
                $coasterFile = $filesystem->get($path);
                break;
            }
        }
        
        if (!isset($coasterFile)) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        $response = new StreamedResponse(
            function() use ($coasterFile) {
                $output = fopen('php://output', 'wb');
                stream_copy_to_stream($coasterFile->readStream(), $output);
                fclose($output);
            });
        
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $coaster->getFilename(),
            $coaster->getFilename($this->get('slugify'))
        );
    
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'application/octet-stream');
        
        return $response;
    }
}
