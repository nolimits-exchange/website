<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners\Coaster\Upload\Started;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster\StyleDetectorInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadStartedEvent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\NolimitsCoasterStyleRepository;

class DetectStyleListener
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;
    
    /**
     * @var NolimitsCoasterStyleRepository
     */
    protected $styleRepository;
    
    /**
     * @var StyleDetectorInterface
     */
    protected $styleDetector;
    
    /**
     * DetectStyleListener constructor.
     *
     * @param FileRepository $fileRepository
     * @param NolimitsCoasterStyleRepository $styleRepository
     * @param StyleDetectorInterface $styleDetector
     */
    public function __construct(
        FileRepository $fileRepository,
        NolimitsCoasterStyleRepository $styleRepository,
        StyleDetectorInterface $styleDetector
    ) {
        $this->fileRepository = $fileRepository;
        $this->styleRepository = $styleRepository;
        $this->styleDetector = $styleDetector;
    }
    
    /**
     * @param UploadStartedEvent $event
     */
    public function onCoasterUploadStarted(UploadStartedEvent $event)
    {
        $coaster = $event->getUploadForm()->getCoaster();
        
        $style = $this->styleDetector->detect($coaster);
        
        $styleEntity = $this->styleRepository->findOneBy([
            'nolimitsId' => $style->getNolimitsId(),
            'version'    => $style->getVersion(),
        ]);
        
        $file = $event->getFile();
        $file->setStyle($styleEntity);
        $this->fileRepository->save($file);
    }
}
