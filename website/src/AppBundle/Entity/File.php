<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Doctrine\ORM\Mapping as ORM;

/**
 * Files.
 *
 * @ORM\Table(name="files", indexes={@ORM\Index(name="IDX_6354059BACD6074", columns={"style_id"}), @ORM\Index(name="IDX_6354059F675F31B", columns={"author_id"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="rating", columns={"rating"})})
 * @ORM\Entity(repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository")
 */
class File
{
    const DISABLED = 0;
    const PUBLISHED = 1;
    const HIDDEN = 2;
    const ARCHIVED = 3;
    const UPLOADING = 4;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=245, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     */
    private $dateAdded;

    /**
     * @var int
     *
     * @ORM\Column(name="last_edited", type="integer", nullable=false)
     */
    private $lastEdited;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

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
     * @var int
     *
     * @ORM\Column(name="downloads", type="integer", nullable=false)
     */
    private $downloads = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $rating = 0.00;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users", inversedBy="files")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users", mappedBy="fileFavourites")
     */
    private $userFavourites;

    /**
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating", mappedBy="file")
     */
    private $ratings;

    /**
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs", mappedBy="file")
     */
    private $downloadLog;

    /**
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NolimitsCoasterStyle", inversedBy="files")
     */
    private $style;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->userFavourites = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->downloadLog = new ArrayCollection();
        $this->lastEdited = time();
        $this->dateAdded = time();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status.
     *
     * @param bool $status
     *
     * @return File
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateAdded.
     *
     * @param int $dateAdded
     *
     * @return File
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded.
     *
     * @return int
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set lastEdited.
     *
     * @param int $lastEdited
     *
     * @return File
     */
    public function setLastEdited($lastEdited)
    {
        $this->lastEdited = $lastEdited;

        return $this;
    }

    /**
     * Get lastEdited.
     *
     * @return int
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return File
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set screenshotExt.
     *
     * @param string $screenshotExt
     *
     * @return File
     */
    public function setScreenshotExt($screenshotExt)
    {
        $this->screenshotExt = $screenshotExt;

        return $this;
    }

    /**
     * Get screenshotExt.
     *
     * @return string
     */
    public function getScreenshotExt()
    {
        return $this->screenshotExt;
    }

    /**
     * Set coasterExt.
     *
     * @param string $coasterExt
     *
     * @return File
     */
    public function setCoasterExt($coasterExt)
    {
        $this->coasterExt = $coasterExt;

        return $this;
    }

    /**
     * Get coasterExt.
     *
     * @return string
     */
    public function getCoasterExt()
    {
        return $this->coasterExt;
    }

    /**
     * Set downloads.
     *
     * @param int $downloads
     *
     * @return File
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;

        return $this;
    }

    /**
     * Get downloads.
     *
     * @return int
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * Set rating.
     *
     * @param string $rating
     *
     * @return File
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating.
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set author.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $author
     *
     * @return File
     */
    public function setAuthor(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return ArrayCollection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @return NolimitsCoasterStyle
     */
    public function getStyle(): NolimitsCoasterStyle
    {
        return $this->style;
    }

    /**
     * @param NolimitsCoasterStyle $style
     */
    public function setStyle(NolimitsCoasterStyle $style)
    {
        $this->style = $style;
    }

    /**
     * @return ArrayCollection
     */
    public function getDownloadLog()
    {
        return $this->downloadLog;
    }

    /**
     * @param mixed $downloadLog
     */
    public function setDownloadLog($downloadLog)
    {
        $this->downloadLog = $downloadLog;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->getName().'.'.$this->getCoasterExt();
    }

    /**
     * Is the coaster rated by this user?
     *
     * @param Users $user
     *
     * @return bool
     */
    public function isRatedByUser(Users $user = null): bool
    {
        return (bool) $this
            ->getRatings()
            ->matching(
                new Criteria(
                    (new ExpressionBuilder())->eq('user', $user)
                )
            )
            ->count();
    }

    /**
     * Was this file downloaded by this user?
     *
     * @param Users $user
     *
     * @return bool
     */
    public function wasDownloadedByUser(Users $user = null): bool
    {
        return (bool) $this
            ->getDownloadLog()
            ->matching(
                new Criteria(
                    (new ExpressionBuilder())->eq('user', $user)
                )
            )
            ->count();
    }

    /**
     * @return Collection
     */
    public function getUserFavourites()
    {
        return $this->userFavourites;
    }
}
