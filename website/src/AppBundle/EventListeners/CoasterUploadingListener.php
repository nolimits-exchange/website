<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\CoasterUploadingEvent;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\QueueService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\FileUploaderInterface;

/**
 * Class CoasterUploadingListener
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners
 */
class CoasterUploadingListener
{
    /**
     * @var FileUploaderInterface
     */
    protected $fileUploader;
    
    /**
     * @var QueueService
     */
    protected $queue;
    
    /**
     * ProcessCoasterUploadListener constructor.
     *
     * @param FileUploaderInterface $fileUploader
     * @param QueueService          $queue
     */
    public function __construct(FileUploaderInterface $fileUploader, QueueService $queue)
    {
        $this->fileUploader = $fileUploader;
        $this->queue = $queue;
    }
    
    /**
     * @param CoasterUploadingEvent $event
     */
    public function onCoasterUpload(CoasterUploadingEvent $event)
    {
        $coaster = $event->getUploadForm()->getCoaster();
        $screenshot = $event->getUploadForm()->getScreenshot();
        $file = $event->getFile();
        
        $this->fileUploader->upload($coaster, $file->getId());
        $this->fileUploader->upload($screenshot, $file->getId());
    
        $queue = $this->queue->attach('process_file_upload');
    
        $queue->push([
            'command' => 'process:file_upload',
            'argument' => [
                'id' => $file->getId(),
            ]
        ]);
    }
}
