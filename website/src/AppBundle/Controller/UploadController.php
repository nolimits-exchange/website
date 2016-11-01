<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\UploadType;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector\NolimitsCoaster1Detector;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector\NolimitsCoaster2Detector;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector\NolimitsCoasterDetector;

/**
 * Class UploadController
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller
 */
class UploadController extends Controller
{
    /**
     * @Route("/upload", name="upload")
     * @Template
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $upload = new Upload();

        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);

        if ($form->isValid()) {
    
            $coasterStyleRepository = $this->getDoctrine()->getRepository('AppBundle:NolimitsCoasterStyle');
    
            // Todo: Move this to a service.
            $nolimitsCoasterDetector = new NolimitsCoasterDetector([
                new NolimitsCoaster1Detector($coasterStyleRepository),
                new NolimitsCoaster2Detector($coasterStyleRepository),
            ]);
            
            $file = $upload->getFileEntity();
            $file->setAuthor($this->getUser());
            $file->setStyle($nolimitsCoasterDetector->read($upload));
    
            $this->getDoctrine()->getRepository('AppBundle:File')->save($file);

            // Todo: Remove silly duplication.
            // Todo: Remove UploadedFile type-hint.
            $this->get('app.file_uploader')->upload($upload->getCoaster(), $file->getId());
            $this->get('app.file_uploader')->upload($upload->getScreenshot(), $file->getId());

            $queue = $this->get('jobqueue')->attach('process_file_upload');

            $queue->push([
                'command' => 'process:file_upload',
                'argument' => [
                    'id' => $file->getId(),
                ]
            ]);

            return $this->redirectToRoute('coaster', [
                'id'   => $file->getId(),
                'slug' => $this->get('slugify')->slugify($file->getName()),
            ]);
        }

        return [
            'form' => $form->createView()
        ];
    }
}
