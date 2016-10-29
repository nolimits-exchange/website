<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils;

class ScreenshotUtil
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
     * @param string $type
     *
     * @return string
     */
    public function getScreenshotPath($id, $ext, $type)
    {
        $id   = sprintf('%010d', $id);
        $path = $this->stringUtil->hashStringIntoPath($id);
        
        return $path . DIRECTORY_SEPARATOR . $id . '_' . $type . '.' . $ext;
    }
}
