<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\EntityFactory;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File as FileEntity;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Form\Upload;

class File
{
    /**
     * @param Upload $upload
     * @param Users  $user
     *
     * @return FileEntity
     */
    public function createFromUpload(Upload $upload, Users $user)
    {
        return (new FileEntity())
            ->setName($upload->getName())
            ->setDescription($upload->getDescription())
            ->setCoasterExt($upload->getCoaster()->guessExtension())
            ->setScreenshotExt($upload->getScreenshot()->guessExtension())
            ->setStatus(FileEntity::UPLOADING)
            ->setAuthor($user)
        ;
    }
}
