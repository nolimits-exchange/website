<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster;

use Symfony\Component\EventDispatcher\Event;
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
    protected $uploadForm;
    
    /**
     * CoasterUploadingEvent constructor.
     *
     * @param Upload $uploadForm
     * @param File   $file
     */
    public function __construct(Upload $uploadForm, File $file)
    {
        $this->uploadForm = $uploadForm;
        $this->file = $file;
    }
    
    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @return Upload
     */
    public function getUploadForm()
    {
        return $this->uploadForm;
    }
}
