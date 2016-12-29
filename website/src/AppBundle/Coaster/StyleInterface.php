<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster;

interface StyleInterface
{
    public function getNolimitsId(): int;
    
    public function getVersion(): int;
}
