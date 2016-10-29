<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Search
 *
 * @ORM\Table(name="search")
 * @ORM\Entity(readOnly=true, repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\SearchRepository")
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity
 */
class Search
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=8, nullable=false)
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", length=1, nullable=false)
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=245, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="float", length=4, nullable=false, precision=2)
     */
    protected $rating;

    /**
     * @var integer
     *
     * @ORM\Column(name="downloads", type="integer", length=8, nullable=false)
     */
    protected $downloads;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", length=11, nullable=false)
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_username", type="string", length=255, nullable=false)
     */
    protected $userUsername;

    /**
     * @var integer
     *
     * @ORM\Column(name="style_id", type="integer", length=8, nullable=false)
     */
    protected $styleId;

    /**
     * @var string
     *
     * @ORM\Column(name="style_name", type="string", length=255, nullable=false)
     */
    protected $styleName;

    /**
     * @var string
     *
     * @ORM\Column(name="style_short", type="string", length=50, nullable=false)
     */
    protected $styleShort;

    /**
     * @var string
     *
     * @ORM\Column(name="screenshot_ext", type="string", length=4, nullable=false)
     */
    private $screenshotExt;

    /**
     * @var string
     *
     * @ORM\Column(name="coaster_ext", type="string", length=8, nullable=false)
     */
    private $coasterExt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUserUsername()
    {
        return $this->userUsername;
    }

    /**
     * @return int
     */
    public function getStyleId()
    {
        return $this->styleId;
    }

    /**
     * @return string
     */
    public function getStyleName()
    {
        return $this->styleName;
    }

    /**
     * @return string
     */
    public function getStyleShort()
    {
        return $this->styleShort;
    }

    /**
     * @return string
     */
    public function getScreenshotExt(): string
    {
        return $this->screenshotExt;
    }

    /**
     * @return string
     */
    public function getCoasterExt(): string
    {
        return $this->coasterExt;
    }
}
