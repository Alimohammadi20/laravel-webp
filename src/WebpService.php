<?php

namespace Alimi7372\WebpConvertor;

use Exception;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as DGDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;

class WebpService
{

    private ImageManager $imageManager;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (class_exists('Imagick')) {
            $driver = ImagickDriver::class;
        } elseif (function_exists('gd_info')) {
            $driver = DGDriver::class;
        } else {
            throw new Exception('The selected image driver is not installed or valid.');
        }
        $this->imageManager = new ImageManager($driver);
    }

    public function convert($imagePath, $outputPath, $quality = 75): string
    {
        $image = $this->imageManager->read($imagePath);
        $image->toWebp($quality);
        $dirname = dirname($outputPath);
        if (!is_dir($dirname)) {
            mkdir($dirname, 777, true);
        }
        $image->save($outputPath);
        return $outputPath;
    }
}
