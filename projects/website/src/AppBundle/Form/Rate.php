<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Rate
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Form
 */
class Rate
{
    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="10")
     * @var double
     */
    protected $technical = 0.00;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="10")
     * @var double
     */
    protected $adrenaline = 0.00;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="10")
     * @var double
     */
    protected $originality = 0.00;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="300")
     * @var string
     */
    protected $comment = '';
    
    /**
     * @return float
     */
    public function getTechnical(): float
    {
        return $this->technical;
    }
    
    /**
     * @param float $technical
     */
    public function setTechnical(float $technical)
    {
        $this->technical = $technical;
    }
    
    /**
     * @return float
     */
    public function getAdrenaline(): float
    {
        return $this->adrenaline;
    }
    
    /**
     * @param float $adrenaline
     */
    public function setAdrenaline(float $adrenaline)
    {
        $this->adrenaline = $adrenaline;
    }
    
    /**
     * @return float
     */
    public function getOriginality(): float
    {
        return $this->originality;
    }
    
    /**
     * @param float $originality
     */
    public function setOriginality(float $originality)
    {
        $this->originality = $originality;
    }
    
    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
    
    /**
     * @param string $comment
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }
    
    /**
     * @return array
     */
    public static function getRange()
    {
        $range = array_map('strval', range(0, 10, 0.5));

        return array_combine($range, $range);
    }
}
