<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsComments
 *
 * @ORM\Table(name="news_comments", indexes={@ORM\Index(name="enabled", columns={"enabled"}), @ORM\Index(name="author_id", columns={"author_id"}), @ORM\Index(name="news_id", columns={"news_id"})})
 * @ORM\Entity
 */
class NewsComments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="author_id", type="integer", nullable=false)
     */
    private $authorId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     */
    private $dateAdded;

    /**
     * @var integer
     *
     * @ORM\Column(name="lft", type="integer", nullable=false)
     */
    private $lft;

    /**
     * @var integer
     *
     * @ORM\Column(name="rgt", type="integer", nullable=false)
     */
    private $rgt;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="integer", nullable=false)
     */
    private $lvl;

    /**
     * @var integer
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
     * @var integer
     *
     * @ORM\Column(name="last_edited", type="integer", nullable=false)
     */
    private $lastEdited;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set authorId
     *
     * @param  integer      $authorId
     * @return NewsComments
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set enabled
     *
     * @param  boolean      $enabled
     * @return NewsComments
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set dateAdded
     *
     * @param  integer      $dateAdded
     * @return NewsComments
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return integer
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set lft
     *
     * @param  integer      $lft
     * @return NewsComments
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param  integer      $rgt
     * @return NewsComments
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param  integer      $lvl
     * @return NewsComments
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set newsId
     *
     * @param  integer      $newsId
     * @return NewsComments
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;

        return $this;
    }

    /**
     * Get newsId
     *
     * @return integer
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * Set content
     *
     * @param  string       $content
     * @return NewsComments
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set lastEdited
     *
     * @param  integer      $lastEdited
     * @return NewsComments
     */
    public function setLastEdited($lastEdited)
    {
        $this->lastEdited = $lastEdited;

        return $this;
    }

    /**
     * Get lastEdited
     *
     * @return integer
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
    }
}
