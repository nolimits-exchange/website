<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Upload
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Form
 */
class Upload
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="32")
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="5000")
     */
    protected $description;

    /**
     * @Assert\File(maxSize="250M")
     * @var UploadedFile
     */
    protected $coaster;

    /**
     * @Assert\Image(maxSize="5M")
     * @var UploadedFile
     */
    protected $screenshot;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Coaster / Park name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Coaster / Park description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Coaster / Park description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getCoaster()
    {
        return $this->coaster;
    }

    /**
     * Coaster upload file.
     *
     * @param UploadedFile $coaster
     *
     * @return $this
     */
    public function setCoaster(UploadedFile $coaster)
    {
        $this->coaster = $coaster;

        return $this;
    }

    /**
     * Screenshot upload file.
     *
     * @return UploadedFile
     */
    public function getScreenshot()
    {
        return $this->screenshot;
    }

    /**
     * Screenshot upload file.
     *
     * @param UploadedFile $screenshot
     *
     * @return $this
     */
    public function setScreenshot(UploadedFile $screenshot)
    {
        $this->screenshot = $screenshot;

        return $this;
    }
}
