<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class NewsContent
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="5000")
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="5000")
     */
    protected $content;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
