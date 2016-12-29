<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\CoasterPublishedEvent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadCoasterService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadScreenshotService;

/**
 * Class CoasterPublishedHandler
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers
 */
class CoasterPublishedHandler
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
     * @return int
     */
    public function handle(File $file): int
    {
        /**
         * Reasons for the coaster not being found.
         *
         * 1. The database was seeded during development, thus changing IDs.
         */
        if (null === $file) {
            return 0;
        }
        
        $coasterUploadReturnCode    = $this->uploadCoasterService->execute($file->getId(), $file->getCoasterExt());
        $screenshotUploadReturnCode = $this->uploadScreenshotService->execute($file->getId(), $file->getScreenshotExt());
        
        $returnCode = $coasterUploadReturnCode === 0 && $screenshotUploadReturnCode === 0;
        
        if ($returnCode) {
            $this->eventDispatcher->dispatch(
                CoasterPublishedEvent::NAME,
                new CoasterPublishedEvent($file)
            );
        }
        
        return 0; // Tolerate broken stuff
    }
}
