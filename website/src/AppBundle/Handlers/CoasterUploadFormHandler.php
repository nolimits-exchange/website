<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers;

use FOS\UserBundle\Model\UserInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\CoasterUploadingEvent;

/**
 * Class CoasterUploadHandler
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers
 */
class CoasterUploadFormHandler
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;
        
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;
    
    /**
     * CoasterUploadFormHandler constructor.
     *
     * @param FileRepository           $fileRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FileRepository $fileRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->fileRepository = $fileRepository;
        $this->eventDispatcher = $eventDispatcher;
    }
    
    /**
     * Starts the file upload process.
     *
     * @param Upload        $upload
     * @param UserInterface $author
     *
     * @return File
     */
    public function handle(Upload $upload, UserInterface $author): File
    {
        $coaster    = $upload->getCoaster();
        $screenshot = $upload->getScreenshot();
        
        $file = new File();
        $file->setName($upload->getName());
        $file->setDescription($upload->getDescription());
        $file->setAuthor($author);
        $file->setCoasterExt($coaster->getClientOriginalExtension());
        $file->setScreenshotExt($screenshot->getClientOriginalExtension());
        $file->setStatus(File::UPLOADING);
        
        $event = new CoasterUploadingEvent($upload, $file);
        
        $this->eventDispatcher->dispatch(CoasterUploadingEvent::NAME, $event);
        
        $this->fileRepository->save($file);
        
        return $file;
    }
}
