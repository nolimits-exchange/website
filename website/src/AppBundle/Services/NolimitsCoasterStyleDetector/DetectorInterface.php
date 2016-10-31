<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle;

/**
 * Interface DetectorInterface
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector
 */
interface DetectorInterface
{
    /**
     * Find a NolimitsCoasterStyle for a given file upload.
     *
     * @param Upload $upload
     *
     * @return NolimitsCoasterStyle
     */
    public function read(Upload $upload): NolimitsCoasterStyle;
    
    /**
     * Decides if the class supports this file upload.
     *
     * @param Upload $upload
     *
     * @return bool
     */
    public function supports(Upload $upload): bool;
}
