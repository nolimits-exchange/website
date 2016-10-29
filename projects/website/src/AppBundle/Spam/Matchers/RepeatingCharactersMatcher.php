<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam\Matchers;

class RepeatingCharactersMatcher implements MatchersInterface
{
    /**
     * @var int 
     */
    protected $minMatches;

    /**
     * RepeatingCharactersMatcher constructor.
     *
     * @param int $minMatches
     */
    public function __construct($minMatches = 4)
    {
        $this->minMatches = (int) $minMatches;
    }
    
    /**
     * A simple repeating character to detect repeating characters / words.
     *
     * @param string $text
     *
     * @return bool
     */
    public function isSpam($text)
    {
        return (bool) preg_match('/(\S+?)\1{'. $this->minMatches .',}/', $text);
    }
}
