<?php
/**
 * Created by PhpStorm.
 * User: mathewdavies
 * Date: 23/12/2016
 * Time: 10:48
 */

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events;

use Symfony\Component\EventDispatcher\Event;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;

/**
 * Class CoasterUploadingEvent
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Events
 */
class CoasterUploadingEvent extends Event
{
    const NAME = 'coaster.uploading';
    
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
