<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use League\Flysystem\FileExistsException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
class FileUploader implements FileUploaderInterface
{
    /**
     * @var string
     */
    protected $directory;
    
    /**
     * FileUploader constructor.
     *
     * @param string $directory
     */
    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }
    
    /**
     * @inheritDoc
     *
     * @throws FileExistsException
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function upload(UploadedFile $file, string $id): string
    {
        $filename = $id . '.' . $file->getClientOriginalExtension();
        
        $file->move($this->directory, $filename);
        
        return $filename;
    }
}
