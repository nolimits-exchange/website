<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EventListeners\Coaster\Upload\Started;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\QueueService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadStartedEvent;

class AddToQueueListener
{
    /**
     * @var QueueService
     */
    protected $queue;
    
    /**
     * AddToQueueListener constructor.
     *
     * @param QueueService $queue
     */
    public function __construct(QueueService $queue)
    {
        $this->queue = $queue;
    }
    
    /**
     * @param UploadStartedEvent $event
     */
    public function onCoasterUploadStarted(UploadStartedEvent $event)
    {
        $queue = $this->queue->attach('process_file_upload');
    
        $queue->push([
            'command' => 'process:file_upload',
            'argument' => [
                'id' => $event->getFile()->getId(),
            ]
        ]);
    }
}
