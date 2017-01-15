<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers\Coaster;

use FOS\UserBundle\Model\UserInterface;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Events\Coaster\UploadStartedEvent;

class UploadStartedHandler
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
     * UploadStartedHandler constructor.
     *
     * @param FileRepository           $fileRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FileRepository $fileRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->fileRepository  = $fileRepository;
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
    
        $this->fileRepository->save($file);
        
        $event = new UploadStartedEvent($file, $upload);
        
        $this->eventDispatcher->dispatch(UploadStartedEvent::NAME, $event);
        
        return $file;
    }
}
