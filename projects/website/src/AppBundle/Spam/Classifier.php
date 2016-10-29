<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam\Matchers\MatchersInterface;

class Classifier implements ClassifierInterface
{
    /**
     * @var MatchersInterface[]
     */
    protected $matchers = [];

    /**
     * @param $matcher
     */
    public function registerMatcher(MatchersInterface $matcher)
    {
        $this->matchers[] = $matcher;
    }

    /**
     * Basic spam classifier 
     * 
     * @param $text
     * @return bool
     */
    public function isSpam($text)
    {
        foreach ($this->matchers as $matcher) {
            if ($matcher->isSpam($text)) {
                return true;
            }
        }
        
        return false;
    }
}
