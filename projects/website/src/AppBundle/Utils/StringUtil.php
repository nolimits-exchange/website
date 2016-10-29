<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils;

class StringUtil
{
    /**
     * Transforms a string into a file path.
     * 
     * @example 
     * 
     *   // 0000008985 -> 0/000/008/985
     * 
     * @param $string
     *
     * @return string
     */
    public function hashStringIntoPath($string)
    {
        return ltrim(strrev(chunk_split(strrev($string), 3, DIRECTORY_SEPARATOR)), DIRECTORY_SEPARATOR);
    }
}
