<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use League\Flysystem\FileExistsException;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
class FileUploader implements FileUploaderInterface
{
    /**
     * @var FilesystemInterface
     */
    protected $ephemeral;

    /**
     * FileUploader constructor.
     *
     * @param FilesystemInterface $ephemeral
     */
    public function __construct(FilesystemInterface $ephemeral)
    {
        $this->ephemeral = $ephemeral;
    }

    /**
     * @inheritDoc
     *
     * @throws FileExistsException
     */
    public function upload(UploadedFile $file, string $id): string
    {
        $filename = $id . '.' . $file->getClientOriginalExtension();

        $splFile = $file->openFile('r');
        
        $this->ephemeral->write(
            $filename,
            $splFile->fread(
                $splFile->getSize()
            )
        );

        return $filename;
    }
}
