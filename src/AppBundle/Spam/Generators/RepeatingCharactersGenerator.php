<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam\Generators;

use Faker\Provider\Base;

class RepeatingCharactersGenerator extends Base
{
    /**
     * @param $string
     * @param $count
     *
     * @return string
     */
    public function repeatingCharacters($string, $count)
    {
        return str_repeat($string, $count);
    }
}
