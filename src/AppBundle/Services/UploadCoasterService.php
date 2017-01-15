<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use League\Flysystem\Adapter\Local;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
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
        
        $coastersFs = $this->mountManager->getAdapter('coasters://');
        
        if ($coastersFs instanceof Local) {
            $this->mountManager->move(
                'ephemeral://' . $source,
                'coasters://' . $dest
            );
            
            return 0;
        }
        
        if ($coastersFs instanceof AwsS3Adapter) {
            $coastersFs->getClient()->registerStreamWrapper();
    
            $coastersFile = fopen('s3://' . $coastersFs->getBucket() . '/' . $coastersFs->getPathPrefix() . $dest, 'w');
    
            stream_copy_to_stream(
                $this->mountManager->readStream('ephemeral://' . $source),
                $coastersFile
            );
    
            fclose($coastersFile);
    
            return 0;
        }
    }
}
