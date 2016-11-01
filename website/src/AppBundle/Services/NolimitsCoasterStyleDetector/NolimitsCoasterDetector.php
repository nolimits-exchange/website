<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle;

/**
 * Class NolimitsCoasterDetector
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector
 */
class NolimitsCoasterDetector implements DetectorInterface
{
    /**
     * @var DetectorInterface[]
     */
    protected $detectors;
    
    /**
     * AllVersionsDetector constructor.
     *
     * @param DetectorInterface[] $detectors
     */
    public function __construct(array $detectors)
    {
        $this->detectors = $detectors;
    }
    
    /**
     * @inheritDoc
     */
    public function read(Upload $upload): NolimitsCoasterStyle
    {
        foreach ($this->detectors as $detector) {
            if ($detector->supports($upload)) {
                return $detector->read($upload);
            }
        }
    }
    
    /**
     * @inheritDoc
     */
    public function supports(Upload $upload): bool
    {
        return true; // Supports everything.
    }
}
