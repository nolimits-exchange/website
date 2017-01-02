<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RatingsVotes.
 *
 * @ORM\Table(name="ratings_votes", indexes={@ORM\Index(name="IDX_FC5CAF33A32EFC6", columns={"rating_id"}), @ORM\Index(name="IDX_FC5CAF33A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class RatingsVotes
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
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean", nullable=false)
     */
    private $state;

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
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rating_id", referencedColumnName="id")
     * })
     */
    private $rating;

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
     * Set state.
     *
     * @param bool $state
     *
     * @return RatingsVotes
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return bool
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set user.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users $user
     *
     * @return RatingsVotes
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
     * Set rating.
     *
     * @param \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating $rating
     *
     * @return RatingsVotes
     */
    public function setRating(\Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating $rating = null)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating.
     *
     * @return \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating
     */
    public function getRating()
    {
        return $this->rating;
    }
}
