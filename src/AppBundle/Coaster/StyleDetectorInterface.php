<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster;

use Symfony\Component\HttpFoundation\File\File;

interface StyleDetectorInterface
{
    public function detect(File $file);
}
