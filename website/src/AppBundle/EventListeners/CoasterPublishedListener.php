<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\CoasterPublishedEvent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;

class CoasterPublishedListener
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
     * @param CoasterPublishedEvent $event
     */
    public function onCoasterPublished(CoasterPublishedEvent $event)
    {
        $coaster = $event->getFile();
        $coaster->setStatus(File::PUBLISHED);
    
        $this->fileRepository->save($coaster);
    }
}
