<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster;

class Style implements StyleInterface
{
    /**
     * @var int
     */
    protected $nolimitsId;
    
    /**
     * @var int
     */
    protected $version;
    
    /**
     * Style constructor.
     *
     * @param int $nolimitsId
     * @param int $version
     */
    public function __construct($nolimitsId, $version)
    {
        $this->nolimitsId = $nolimitsId;
        $this->version = $version;
    }
    
    /**
     * @return int
     */
    public function getNolimitsId(): int
    {
        return $this->nolimitsId;
    }
    
    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }
}
