<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam\Matchers;

interface MatchersInterface
{
    /**
     * Classifies a bit of text as spam or not.
     * 
     * @param $text
     * @return bool
     */
    public function isSpam($text);
}
