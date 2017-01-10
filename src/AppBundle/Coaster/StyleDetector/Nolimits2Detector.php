<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster\StyleDetector;

use ZipArchive;
use Thepixeldeveloper\Nolimits2PackageLoader\Package;
use Symfony\Component\HttpFoundation\File\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster\Style;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster\StyleDetectorInterface;

class Nolimits2Detector implements StyleDetectorInterface
{
    const VERSION = 2;
    
    /**
     * @param File $file
     *
     * @return Style|null
     */
    public function detect(File $file)
    {
        if ($file->getExtension() !== 'nl2pkg') {
            return null;
        }
        
        $archive = new ZipArchive();
        $archive->open($file->getPathname());
        
        $package  = new Package($archive);
        $coasters = $package->getCoasters();
        $styleId  = $coasters->current()->getStyleId();
        
        return new Style($styleId,self::VERSION);
    }
}
