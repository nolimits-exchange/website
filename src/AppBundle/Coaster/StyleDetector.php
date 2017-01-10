<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster;

use Symfony\Component\HttpFoundation\File\File;

class StyleDetector implements StyleDetectorInterface
{
    /**
     * @var StyleDetectorInterface[]
     */
    protected $detectors = [];
    
    /**
     * StyleDetector constructor.
     *
     * @param StyleDetectorInterface[] $detectors
     */
    public function __construct(array $detectors)
    {
        $this->detectors = $detectors;
    }
    
    /**
     * @param File $file
     *
     * @return StyleInterface
     */
    public function detect(File $file)
    {
        foreach ($this->detectors as $detector) {
            if (null !== $result = $detector->detect($file)) {
                return $result;
            }
        }
    }
}
