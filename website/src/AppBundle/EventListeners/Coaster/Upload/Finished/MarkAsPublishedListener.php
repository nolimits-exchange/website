<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners\Coaster\Upload\Finished;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadFinishedEvent;

class MarkAsPublishedListener
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;
    
    /**
     * CoasterPublishedListener constructor.
     *
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }
    
    /**
     * @param UploadFinishedEvent $event
     */
    public function onCoasterUploadFinished(UploadFinishedEvent $event)
    {
        $coaster = $event->getFile();
        $coaster->setStatus(File::PUBLISHED);
        $this->fileRepository->save($coaster);
    }
}
