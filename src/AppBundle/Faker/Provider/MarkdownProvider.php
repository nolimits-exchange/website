<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Faker\Provider;

use Faker\Provider\Base;

/**
 * Class MarkdownProvider
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Faker\Provider
 */
class MarkdownProvider extends Base
{
    /**
     * Generate markdown paragraphs.
     *
     * @param int $paragraphs
     *
     * @return string
     */
    public function markdownParagraphs($paragraphs)
    {
        return implode("\r\n", $this->generator->paragraphs($paragraphs));
    }
}
