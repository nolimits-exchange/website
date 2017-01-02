<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * News.
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsRepository")
 */
class News
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
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsCategory
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsCategory", inversedBy="articles")
     */
    private $category;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=false)
     */
    private $summary;

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
     * @ORM\Column(name="url", type="string", length=45, nullable=false)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits;

    /**
     * @var int
     *
     * @ORM\Column(name="unique_hits", type="integer", nullable=false)
     */
    private $uniqueHits;

    /**
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsContents", mappedBy="article")
     * @ORM\OrderBy({"order" = "ASC"})
     */
    private $pages;

    public function __construct()
    {
        $this->dateAdded = time();
        $this->lastEdited = time();
        $this->hits = 0;
        $this->uniqueHits = 0;
        $this->pages = new ArrayCollection();
    }

    /**
     * @return PersistentCollection
     */
    public function getPages()
    {
        return $this->pages;
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
     * Set authorId.
     *
     * @param Users $author
     *
     * @return News
     */
    public function setAuthor(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return Users
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set categoryId.
     *
     * @param NewsCategory $category
     *
     * @return News
     */
    public function setCategory(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\NewsCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get categoryId.
     *
     * @return NewsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set enabled.
     *
     * @param bool $enabled
     *
     * @return News
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
     * Set name.
     *
     * @param string $name
     *
     * @return News
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
     * Set summary.
     *
     * @param string $summary
     *
     * @return News
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary.
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set dateAdded.
     *
     * @param int $dateAdded
     *
     * @return News
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
     * @return News
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
     * Set url.
     *
     * @param string $url
     *
     * @return News
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set hits.
     *
     * @param int $hits
     *
     * @return News
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits.
     *
     * @return int
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set uniqueHits.
     *
     * @param int $uniqueHits
     *
     * @return News
     */
    public function setUniqueHits($uniqueHits)
    {
        $this->uniqueHits = $uniqueHits;

        return $this;
    }

    /**
     * Get uniqueHits.
     *
     * @return int
     */
    public function getUniqueHits()
    {
        return $this->uniqueHits;
    }
}
