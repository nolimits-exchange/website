<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector;

use ZipArchive;
use Thepixeldeveloper\Nolimits2PackageLoader\Package;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\NolimitsCoasterStyleRepository;

/**
 * Class NolimitsCoaster2Detector
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector
 */
class NolimitsCoaster2Detector implements DetectorInterface
{
    const VERSION = 2;
    
    /**
     * @var NolimitsCoasterStyleRepository
     */
    protected $repository;
    
    /**
     * NolimitsCoaster2 constructor.
     *
     * @param NolimitsCoasterStyleRepository $repository
     */
    public function __construct(NolimitsCoasterStyleRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @inheritDoc
     */
    public function read(Upload $upload): NolimitsCoasterStyle
    {
        $zip = new ZipArchive;
        $zip->open($upload->getCoaster()->getRealPath());
    
        $package = new Package($zip);
        $nolimitsId = $package->getCoasters()->current()->getStyleId();
        
        return $this->repository->findOneBy([
            'nolimitsId' => $nolimitsId,
            'version'    => self::VERSION,
        ]);
    }
    
    /**
     * @inheritDoc
     */
    public function supports(Upload $upload): bool
    {
        $extension = strtolower($upload->getCoaster()->getClientOriginalExtension());
        
        return in_array($extension, ['nlpack'], true);
    }
}
