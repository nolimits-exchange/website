<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners\Coaster\Upload\Started;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\FileUploaderInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadStartedEvent;

class MoveToEphemeralListener
{
    /**
     * @var FileUploaderInterface
     */
    protected $fileUploader;
    
    /**
     * ProcessCoasterUploadListener constructor.
     *
     * @param FileUploaderInterface $fileUploader
     */
    public function __construct(FileUploaderInterface $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }
    
    /**
     * @param UploadStartedEvent $event
     */
    public function onCoasterUploadStarted(UploadStartedEvent $event)
    {
        $coaster    = $event->getUploadForm()->getCoaster();
        $screenshot = $event->getUploadForm()->getScreenshot();
        $file       = $event->getFile();
        
        $this->fileUploader->upload($coaster, $file->getId());
        $this->fileUploader->upload($screenshot, $file->getId());
    }
}
