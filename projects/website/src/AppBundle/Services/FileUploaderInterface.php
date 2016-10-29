<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface FileUploaderInterface
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
interface FileUploaderInterface
{
    /**
     * @param UploadedFile $file
     * @param string       $id
     *
     * @return string
     */
    public function upload(UploadedFile $file, string $id): string;
}
