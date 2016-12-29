<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster;

use Symfony\Component\EventDispatcher\Event;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;

/**
 * Class UploadFinishedEvent
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster
 */
class UploadFinishedEvent extends Event
{
    const NAME = 'coaster.upload.finished';
    
    /**
     * @var File
     */
    protected $file;
    
    /**
     * CoasterUploadingEvent constructor.
     *
     * @param File   $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }
    
    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
}
