<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use League\Flysystem\FileExistsException;
use League\Flysystem\FilesystemInterface;
use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
     */
    protected $logger;
    
    /**
     * FileUploader constructor.
     *
     * @param FilesystemInterface $ephemeral
     * @param LoggerInterface     $logger
     */
    public function __construct(FilesystemInterface $ephemeral, LoggerInterface $logger)
    {
        $this->ephemeral = $ephemeral;
        $this->logger = $logger;
    }
    
    /**
     * @inheritDoc
     *
     * @throws FileExistsException
     */
    public function upload(UploadedFile $file, string $id): string
    {
        $filename = $id . '.' . $file->getClientOriginalExtension();
        $stream   = fopen($file->getRealPath(), 'rb+');
        
        $written = $this->ephemeral->writeStream($filename, $stream);
        
        fclose($stream);
        
        $this->logger->info('Upload path', ['path' => $file->getRealPath()]);
        $this->logger->critical('writeStream called', ['result' => $written]);
        
        return $filename;
    }
}
