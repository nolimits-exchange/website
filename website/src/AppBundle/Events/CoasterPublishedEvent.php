<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Events;

use Symfony\Component\EventDispatcher\Event;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;

/**
 * Class CoasterPublishedEvent
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Events
 */
class CoasterPublishedEvent extends Event
{
    const NAME = 'coaster.published';
    
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
