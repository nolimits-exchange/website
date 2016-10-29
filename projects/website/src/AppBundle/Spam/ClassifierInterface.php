<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam;

interface ClassifierInterface
{
    public function isSpam($text);
}
