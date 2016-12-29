<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster;

use Symfony\Component\EventDispatcher\Event;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;

/**
 * Class UploadInProgressEvent
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster
 */
class UploadInProgressEvent extends Event
{
    const NAME = 'coaster.upload.in_progress';
    
    /**
     * @var File
     */
    protected $file;
    
    /**
     * UploadInProgressEvent constructor.
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
