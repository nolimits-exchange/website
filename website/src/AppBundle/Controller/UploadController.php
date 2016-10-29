<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Thepixeldeveloper\Nolimits2PackageLoader\Package;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\UploadType;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use ZipArchive;

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

            $coaster    = $upload->getCoaster();
            $screenshot = $upload->getScreenshot();

            $file = new File();
            $file->setName($upload->getName());
            $file->setDescription($upload->getDescription());
            $file->setAuthor($this->getUser());
            $file->setCoasterExt($coaster->getClientOriginalExtension());
            $file->setScreenshotExt($screenshot->getClientOriginalExtension());
            $file->setStatus(File::UPLOADING);
    
            $zip = new ZipArchive;
            $zip->open($coaster->getRealPath());
            
            $package = new Package($zip);
            
            $file->setStyle(
                $this->getDoctrine()->getRepository('AppBundle:NolimitsCoasterStyle')->findOneBy([
                    'nolimitsId' => $package->getCoasters()->current()->getStyleId(),
                    'version'    => 2,
                ])
            );
    
            $this->getDoctrine()->getRepository('AppBundle:File')->save($file);

            $this->get('app.file_uploader')->upload($coaster, $file->getId());
            $this->get('app.file_uploader')->upload($screenshot, $file->getId());

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
