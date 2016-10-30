<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Search.
 *
 * @ORM\Table(name="search_types")
 * @ORM\Entity(readOnly=true, repositoryClass="Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\SearchTypesRepository")
 */
class SearchTypes
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=8, nullable=false)
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
     * @ORM\Column(name="version", type="integer", length=11, nullable=false)
     */
    protected $version;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", length=11, nullable=false)
     */
    protected $count;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get version as a string.
     *
     * @return string
     */
    public function getVersionAsString(): string
    {
        $map = [
            1 => 'NL1',
            2 => 'NL2',
        ];

        return $map[$this->getVersion()];
    }

    /**
     * Get name with count in parenthesis.
     *
     * @return string
     */
    public function getNameWithCounts(): string
    {
        return sprintf('%s (%d)', $this->getName(), $this->getCount());
    }
}
