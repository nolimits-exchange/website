<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Search
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Form
 */
class Search
{
    /**
     * @var string
     * @Assert\Type(type="string")
     */
    protected $term;

    /**
     * @Assert\Type(type="integer")
     */
    protected $type;

    /**
     * @Assert\Type(type="integer")
     */
    protected $downloadsFrom;

    /**
     * @Assert\Type(type="integer")
     */
    protected $downloadsTo;

    /**
     * @Assert\Type(type="integer")
     */
    protected $ratingsFrom;

    /**
     * @Assert\Type(type="integer")
     */
    protected $ratingsTo;

    /**
     * @Assert\Choice(choices = {"asc", "desc"}, message = "Choose a valid sort direction.")
     */
    protected $downloadsSort;

    /**
     * @Assert\Choice(choices = {"asc", "desc"}, message = "Choose a valid sort direction.")
     */
    protected $ratingsSort;

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDownloadsFrom()
    {
        return $this->downloadsFrom;
    }

    /**
     * @param mixed $downloadsFrom
     */
    public function setDownloadsFrom($downloadsFrom)
    {
        $this->downloadsFrom = $downloadsFrom;
    }

    /**
     * @return mixed
     */
    public function getDownloadsTo()
    {
        return $this->downloadsTo;
    }

    /**
     * @param mixed $downloadsTo
     */
    public function setDownloadsTo($downloadsTo)
    {
        $this->downloadsTo = $downloadsTo;
    }

    /**
     * @return mixed
     */
    public function getRatingsFrom()
    {
        return $this->ratingsFrom;
    }

    /**
     * @param mixed $ratingsFrom
     */
    public function setRatingsFrom($ratingsFrom)
    {
        $this->ratingsFrom = $ratingsFrom;
    }

    /**
     * @return mixed
     */
    public function getRatingsTo()
    {
        return $this->ratingsTo;
    }

    /**
     * @param mixed $ratingsTo
     */
    public function setRatingsTo($ratingsTo)
    {
        $this->ratingsTo = $ratingsTo;
    }

    /**
     * @return mixed
     */
    public function getDownloadsSort()
    {
        return $this->downloadsSort;
    }

    /**
     * @return string
     */
    public function getDownloadsSortInverse()
    {
        if ($sort = $this->getDownloadsSort()) {
            return $this->getSortInverse($sort);
        }
    }

    /**
     * @param mixed $downloadsSort
     */
    public function setDownloadsSort($downloadsSort)
    {
        $this->downloadsSort = $downloadsSort;
    }

    /**
     * @return mixed
     */
    public function getRatingsSort()
    {
        return $this->ratingsSort;
    }

    /**
     * @return string
     */
    public function getRatingsSortInverse()
    {
        if ($sort = $this->getRatingsSort()) {
            return $this->getSortInverse($sort);
        }
    }

    /**
     * @param mixed $ratingsSort
     */
    public function setRatingsSort($ratingsSort)
    {
        $this->ratingsSort = $ratingsSort;
    }

    /**
     * @param string $sort
     *
     * @return string
     */
    protected function getSortInverse(string $sort): string
    {
        return $sort === 'asc' ? 'desc' : 'asc';
    }
}
