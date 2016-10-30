<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * FileRating.
 *
 * @ORM\Table(name="file_ratings", indexes={@ORM\Index(name="IDX_95D0BEF293CB796C", columns={"file_id"}), @ORM\Index(name="IDX_95D0BEF2A76ED395", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRatingRepository")
 */
class FileRating
{
    const PUBLISHED = 1;
    const QUEUED = 2;
    const DISABLED = 3;
    const REPORTED = 3;

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
     * @ORM\Column(name="technical", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $technical;

    /**
     * @var string
     *
     * @ORM\Column(name="originality", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $originality;

    /**
     * @var string
     *
     * @ORM\Column(name="adrenaline", type="decimal", precision=4, scale=2, nullable=false)
     */
    private $adrenaline;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", inversedBy="ratings")
     */
    private $file;

    /**
     * FileRating constructor.
     */
    public function __construct()
    {
        $this->dateAdded = (new DateTimeImmutable())->getTimestamp();
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
     * @return FileRating
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set technical.
     *
     * @param string $technical
     *
     * @return FileRating
     */
    public function setTechnical($technical)
    {
        $this->technical = $technical;

        return $this;
    }

    /**
     * Get technical.
     *
     * @return string
     */
    public function getTechnical()
    {
        return $this->technical;
    }

    /**
     * Set originality.
     *
     * @param string $originality
     *
     * @return FileRating
     */
    public function setOriginality($originality)
    {
        $this->originality = $originality;

        return $this;
    }

    /**
     * Get originality.
     *
     * @return string
     */
    public function getOriginality()
    {
        return $this->originality;
    }

    /**
     * Set adrenaline.
     *
     * @param string $adrenaline
     *
     * @return FileRating
     */
    public function setAdrenaline($adrenaline)
    {
        $this->adrenaline = $adrenaline;

        return $this;
    }

    /**
     * Get adrenaline.
     *
     * @return string
     */
    public function getAdrenaline()
    {
        return $this->adrenaline;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return FileRating
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set dateAdded.
     *
     * @param int $dateAdded
     *
     * @return FileRating
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
     * Set user.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $user
     *
     * @return FileRating
     */
    public function setUser(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set file.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File $file
     *
     * @return FileRating
     */
    public function setFile(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File
     */
    public function getFile()
    {
        return $this->file;
    }
}
