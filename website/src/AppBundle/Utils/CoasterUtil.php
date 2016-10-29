<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils;

class CoasterUtil
{
    /**
     * @var StringUtil
     */
    protected $stringUtil;

    /**
     * @param StringUtil $stringUtil
     */
    public function __construct(StringUtil $stringUtil)
    {
        $this->stringUtil = $stringUtil;
    }

    /**
     * @param string $id
     * @param string $ext
     *
     * @return string
     *
     */
    public function getCoasterPath($id, $ext)
    {
        $id   = sprintf('%010d', $id);
        $path = $this->stringUtil->hashStringIntoPath($id);
        
        return substr($path, 0, strrpos($path, DIRECTORY_SEPARATOR, -0)) . DIRECTORY_SEPARATOR . $id . '.' . $ext;
    }
}
