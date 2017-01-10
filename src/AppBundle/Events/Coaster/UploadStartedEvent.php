<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\File\File as CoasterFile;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;

/**
 * Class UploadStartedEvent
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster
 */
class UploadStartedEvent extends Event
{
    const NAME = 'coaster.upload.started';
    
    /**
     * @var File
     */
    protected $file;
    
    /**
     * @var CoasterFile
     */
    protected $coaster;
    
    /**
     * UploadStartedEvent constructor.
     *
     * @param File        $file
     * @param CoasterFile $coaster
     */
    public function __construct(File $file, CoasterFile $coaster)
    {
        $this->file = $file;
        $this->coaster = $coaster;
    }
    
    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @return CoasterFile
     */
    public function getCoaster(): CoasterFile
    {
        return $this->coaster;
    }
}
