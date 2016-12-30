<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", mappedBy="author")
     */
    protected $files;

    /**
     * @ORM\ManyToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", inversedBy="downloadLog")
     * @ORM\JoinTable(name="file_logs", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    protected $downloadLog;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", inversedBy="userFavourites")
     * @ORM\JoinTable(name="file_favourites")
     */
    protected $fileFavourites;

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
}
