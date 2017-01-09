<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers\Coaster;

use FOS\UserBundle\Model\UserInterface;
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
     * @var string
     */
    protected $directory;
    
    /**
     * UploadStartedHandler constructor.
     *
     * @param FileRepository           $fileRepository
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $directory
     */
    public function __construct(FileRepository $fileRepository, EventDispatcherInterface $eventDispatcher, $directory)
    {
        $this->fileRepository = $fileRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->directory = $directory;
    }
    
    /**
     * Starts the file upload process.
     *
     * @param Upload        $upload
     * @param UserInterface $author
     *
     * @return File
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
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
        
        $coaster    = $coaster->move($this->directory, $file->getId() . '.' . $coaster->getClientOriginalExtension());
        $screenshot = $screenshot->move($this->directory, $file->getId() . '.' . $screenshot->getClientOriginalExtension());
        
        $upload->setCoaster($coaster);
        $upload->setScreenshot($screenshot);
        
        $event = new UploadStartedEvent($upload, $file);
        
        $this->eventDispatcher->dispatch(UploadStartedEvent::NAME, $event);
        
        return $file;
    }
}
