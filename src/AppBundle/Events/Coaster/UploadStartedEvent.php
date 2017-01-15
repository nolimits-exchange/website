<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\File\File as CoasterFile;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;

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
     * @var Upload
     */
    protected $upload;
    
    /**
     * UploadStartedEvent constructor.
     *
     * @param File   $file
     * @param Upload $upload
     */
    public function __construct(File $file, Upload $upload)
    {
        $this->file = $file;
        $this->upload = $upload;
    }
    
    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }
    
    /**
     * @return Upload
     */
    public function getUpload(): Upload
    {
        return $this->upload;
    }
    
}
