<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class News
{
//    /**
//     * @Assert\NotBlank()
//     * @Assert\Length(min="4", max="32")
//     */
//    protected $author;
//
//    /**
//     * @Assert\NotBlank()
//     * @Assert\Length(max="5000")
//     */
//    protected $category;
//
//    /**
//     * @Assert\File(maxSize="250M")
//     * @var UploadedFile
//     */
//    protected $enabled;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="5000")
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="5000")
     */
    protected $summary;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
}
