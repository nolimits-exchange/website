<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers\Coaster;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadInProgressEvent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadCoasterService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadScreenshotService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadFinishedEvent;

class UploadFinishedHandler
{
    /**
     * @var UploadCoasterService
     */
    protected $uploadCoasterService;
    
    /**
     * @var UploadScreenshotService
     */
    protected $uploadScreenshotService;
    
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;
    
    /**
     * CoasterPublishedHandler constructor.
     *
     * @param UploadCoasterService     $uploadCoasterService
     * @param UploadScreenshotService  $uploadScreenshotService
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        UploadCoasterService $uploadCoasterService,
        UploadScreenshotService $uploadScreenshotService,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->uploadCoasterService = $uploadCoasterService;
        $this->uploadScreenshotService = $uploadScreenshotService;
        $this->eventDispatcher = $eventDispatcher;
    }
    
    /**
     * Moves the file and screenshot to permanent storage and
     * sets the status as published.
     *
     * @param File $file
     *
     * @return mixed
     */
    public function handle(File $file)
    {
        if (null === $file) {
            return null;
        }
    
        $this->eventDispatcher->dispatch(
            UploadInProgressEvent::NAME,
            new UploadInProgressEvent($file)
        );
        
        $coasterUploadReturnCode    = $this->uploadCoasterService->execute($file->getId(), $file->getCoasterExt());
        $screenshotUploadReturnCode = $this->uploadScreenshotService->execute($file->getId(), $file->getScreenshotExt());
        
        $returnCode = $coasterUploadReturnCode === 0 && $screenshotUploadReturnCode === 0;
        
        if ($returnCode) {
            $this->eventDispatcher->dispatch(
                UploadFinishedEvent::NAME,
                new UploadFinishedEvent($file)
            );
        }
        
        return 0; // Tolerate broken stuff
    }
}
