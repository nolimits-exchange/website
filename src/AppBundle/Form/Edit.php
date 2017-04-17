<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class Edit
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
}
