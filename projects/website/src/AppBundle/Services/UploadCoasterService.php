<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils\CoasterUtil;

/**
 * Class UploadCoasterService
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
class UploadCoasterService extends UploadService
{
    /**
     * @var CoasterUtil
     */
    protected $coasterUtil;

    /**
     * UploadCoasterService constructor.
     *
     * @param CoasterUtil $coasterUtil
     */
    public function __construct(CoasterUtil $coasterUtil)
    {
        $this->coasterUtil = $coasterUtil;
    }

    /**
     * @param string $id
     * @param string $ext
     *
     * @return int
     */
    public function execute(string $id, string $ext): int
    {
        $source = $this->getSourceName($id, $ext);
        $dest   = $this->coasterUtil->getCoasterPath($id, $ext);

        $this->mountManager->move(
            'ephemeral://' . $source,
            'coasters://' . $dest
        );

        return 0;
    }
}
