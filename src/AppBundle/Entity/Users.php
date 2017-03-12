<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;

/**
 * Users.
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\UserRepository")
 */
class Users extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", mappedBy="author")
     */
    protected $files;

    /**
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileLogs", mappedBy="user")
     */
    protected $downloadLog;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", inversedBy="userFavourites")
     * @ORM\JoinTable(name="file_favourites",
     *     joinColumns={
     *         @ORM\JoinColumn(name="user_id", referencedColumnName="id"
     *     )
     * })
     */
    protected $fileFavourites;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating", mappedBy="user")
     */
    protected $ratings;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->files = new ArrayCollection();
        $this->fileFavourites = new ArrayCollection();
        $this->downloadLog = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDownloadLog()
    {
        return $this->downloadLog;
    }
    
    /**
     * @return Collection
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }
    
    /**
     * @return Collection
     */
    public function getFileFavourites(): Collection
    {
        return $this->fileFavourites;
    }
    
    /**
     * @return Collection
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }
}
