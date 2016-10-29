<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use Exception;
use Intervention\Image\Image;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Utils\ScreenshotUtil;

/**
 * Class UploadScreenshotService
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Services
 */
class UploadScreenshotService extends UploadService
{
    /**
     * @var ScreenshotUtil
     */
    protected $screenshotUtil;

    /**
     * @var ImageManager
     */
    protected $intervention;

    /**
     * UploadScreenshotService constructor.
     *
     * @param ScreenshotUtil $screenshotUtil
     * @param ImageManager   $intervention
     */
    public function __construct(ScreenshotUtil $screenshotUtil, ImageManager $intervention)
    {
        $this->screenshotUtil = $screenshotUtil;
        $this->intervention = $intervention;
    }

    /**
     * @param string $id
     * @param string $ext
     *
     * @return mixed|void
     */
    public function execute($id, $ext)
    {
        $source = $this->getSourceName($id, $ext);

        try {
            $screenshot = $this->mountManager->read('ephemeral://' . $source);

            $image = $this->intervention->make($screenshot);

            $thumbnails = [
                'large'     => [640, null],
                'small'     => [280, 210],
                'thumbnail' => [40, 35],
            ];

            foreach ($thumbnails as $name => $dim) {
                $data = $this->generateThumbnail(
                    $image,
                    $dim[0],
                    $dim[1]
                );

                $dest = $this->screenshotUtil->getScreenshotPath(
                    $id,
                    $ext,
                    $name
                );

                $this->mountManager->write('screenshots://' . $dest, $data);
            }

            $dest = $this->screenshotUtil->getScreenshotPath(
                $id,
                $ext,
                'original'
            );

            $this->mountManager->move(
                'ephemeral://' . $source,
                'screenshots://' . $dest
            );

        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            return 1;
        }
        
        return 0;
    }

    /**
     * @param Image $image
     * @param null  $width
     * @param null  $height
     *
     * @return string
     */
    protected function generateThumbnail(Image $image, $width = null, $height = null)
    {
        $image->resize($width, $height, function (Constraint $constraint) use ($width, $height) {
            if ($width === null || $height === null) {
                $constraint->aspectRatio();    
            }
        });

        return $image->encode(null, 100)->getEncoded();
    }
}
