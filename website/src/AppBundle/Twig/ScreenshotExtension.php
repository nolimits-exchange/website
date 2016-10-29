<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Twig;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils\ScreenshotUtil;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class ScreenshotExtension
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Twig
 */
class ScreenshotExtension extends Twig_Extension
{
    /**
     * @var ScreenshotUtil
     */
    protected $screenshotUtil;

    /**
     * ScreenshotExtension constructor.
     *
     * @param ScreenshotUtil $screenshotUtil
     */
    public function __construct(ScreenshotUtil $screenshotUtil)
    {
        $this->screenshotUtil = $screenshotUtil;
    }
    
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new Twig_SimpleFunction('screenshot_path', [$this->screenshotUtil, 'getScreenshotPath']),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'app_screenshot';
    }
}
