<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsComments.
 *
 * @ORM\Table(name="news_comments", indexes={@ORM\Index(name="enabled", columns={"enabled"}), @ORM\Index(name="author_id", columns={"author_id"}), @ORM\Index(name="news_id", columns={"news_id"})})
 * @ORM\Entity
 */
class NewsComments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="author_id", type="integer", nullable=false)
     */
    private $authorId;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var int
     *
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     */
    private $dateAdded;

    /**
     * @var int
     *
     * @ORM\Column(name="lft", type="integer", nullable=false)
     */
    private $lft;

    /**
     * @var int
     *
     * @ORM\Column(name="rgt", type="integer", nullable=false)
     */
    private $rgt;

    /**
     * @var int
     *
     * @ORM\Column(name="lvl", type="integer", nullable=false)
     */
    private $lvl;

    /**
     * @var int
     *
     * @ORM\Column(name="news_id", type="integer", nullable=false)
     */
    private $newsId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="last_edited", type="integer", nullable=false)
     */
    private $lastEdited;

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
     * Set authorId.
     *
     * @param int $authorId
     *
     * @return NewsComments
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId.
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set enabled.
     *
     * @param bool $enabled
     *
     * @return NewsComments
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled.
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set dateAdded.
     *
     * @param int $dateAdded
     *
     * @return NewsComments
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
     * Set lft.
     *
     * @param int $lft
     *
     * @return NewsComments
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft.
     *
     * @return int
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt.
     *
     * @param int $rgt
     *
     * @return NewsComments
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt.
     *
     * @return int
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl.
     *
     * @param int $lvl
     *
     * @return NewsComments
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl.
     *
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set newsId.
     *
     * @param int $newsId
     *
     * @return NewsComments
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;

        return $this;
    }

    /**
     * Get newsId.
     *
     * @return int
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return NewsComments
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set lastEdited.
     *
     * @param int $lastEdited
     *
     * @return NewsComments
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
}
