<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use Psr\Log\LoggerInterface;
use League\Flysystem\MountManager;

/**
 * Class UploadService
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
class UploadService
{
    /**
     * @var MountManager
     */
    protected $mountManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param MountManager $mountManager
     */
    public function setMountManager($mountManager)
    {
        $this->mountManager = $mountManager;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $id
     * @param string $ext
     *
     * @return string
     */
    public function getSourceName(string $id, string $ext): string
    {
        return $id . '.' . $ext;
    }
}
