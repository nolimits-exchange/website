<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileLogs
 *
 * @ORM\Table(name="file_logs", indexes={@ORM\Index(name="IDX_7973AE3293CB796C", columns={"file_id"}), @ORM\Index(name="IDX_7973AE32A76ED395", columns={"user_id"}), @ORM\Index(name="date_added", columns={"date_added"})})
 * @ORM\Entity
 */
class FileLogs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_added", type="integer", nullable=false)
     */
    protected $dateAdded;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * @var \Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File
     *
     * @ORM\ManyToOne(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", inversedBy="downloadLog")
     */
    protected $file;
    
    /**
     * FileLogs constructor.
     */
    public function __construct()
    {
        $this->dateAdded = time();
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @return int
     */
    public function getDateAdded(): int
    {
        return $this->dateAdded;
    }
    
    /**
     * @param int $dateAdded
     */
    public function setDateAdded(int $dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }
    
    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }
    
    /**
     * @param Users $user
     */
    public function setUser(Users $user)
    {
        $this->user = $user;
    }
    
    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }
    
    /**
     * @param File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }
}
