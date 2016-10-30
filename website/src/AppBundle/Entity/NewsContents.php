<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsContents.
 *
 * @ORM\Table(name="news_contents", indexes={@ORM\Index(name="IDX_FDC4B226B5A459A0", columns={"news_id"})})
 * @ORM\Entity
 */
class NewsContents
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News", inversedBy="pages")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $article;

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
     * Set name.
     *
     * @param string $name
     *
     * @return NewsContents
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
     * Set order.
     *
     * @param int $order
     *
     * @return NewsContents
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return NewsContents
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
     * Set news.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News $news
     *
     * @return NewsContents
     */
    public function setArticle(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News $news = null)
    {
        $this->article = $news;

        return $this;
    }

    /**
     * Get news.
     *
     * @return \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\News
     */
    public function getArticle()
    {
        return $this->article;
    }
}
