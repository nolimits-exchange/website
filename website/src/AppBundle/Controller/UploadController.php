<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Type\UploadType;

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
            
            $file = $this
                ->get('handler.coaster.upload.started')
                ->handle($upload, $this->getUser());

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
