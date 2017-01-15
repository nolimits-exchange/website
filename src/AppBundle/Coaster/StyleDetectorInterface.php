<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Coaster;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface StyleDetectorInterface
{
    public function detect(UploadedFile $file);
}
