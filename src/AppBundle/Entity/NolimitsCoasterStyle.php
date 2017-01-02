<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Files.
 *
 * @ORM\Table(name="nolimits_coaster_styles")
 * @ORM\Entity(repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\NolimitsCoasterStyleRepository")
 */
class NolimitsCoasterStyle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="nolimits_id", type="integer", length=8, nullable=false)
     */
    protected $nolimitsId;

    /**
     * @var string
     *
     * @ORM\Column(name="short", type="string", length=50, nullable=false)
     */
    protected $short;

    /**
     * @var int
     *
     * @ORM\Column(name="version", type="integer", length=11, nullable=false)
     */
    protected $version;

    /**
     * @ORM\OneToMany(targetEntity="Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File", mappedBy="style")
     */
    protected $files;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getNolimitsId(): int
    {
        return $this->nolimitsId;
    }

    /**
     * @param int $nolimitsId
     */
    public function setNolimitsId(int $nolimitsId)
    {
        $this->nolimitsId = $nolimitsId;
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->short;
    }

    /**
     * @param string $short
     */
    public function setShort(string $short)
    {
        $this->short = $short;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion(int $version)
    {
        $this->version = $version;
    }
}
