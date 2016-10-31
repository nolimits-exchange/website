<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\NolimitsCoasterStyleRepository;

/**
 * Class NolimitsCoaster1Detector
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\NolimitsCoasterStyleDetector
 */
class NolimitsCoaster1Detector implements DetectorInterface
{
    const VERSION = 1;
    
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
        $nolimitsId = 1;
        
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
    
        return in_array($extension, ['nltrack', 'nlpack'], true);
    }
}
