<?php

namespace Alimi7372\WebpConvertor;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Illuminate\Support\Facades\Config;

class WebpService
{

    private ImageManager $imageManager;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $driver = Config::get('webp.driver');

        if (class_exists('Imagick')) {
            $diver = new ImagickDriver();
        } elseif (function_exists('gd_info')) {
            $diver = new GdDriver();
        } else {
            throw new \Exception('The selected image driver is not installed or valid.');
        }
        $this->imageManager = new ImageManager($diver);
    }
    public function convert($imagePath, $outputPath, $quality = 75)
    {
        $image = $this->imageManager->read($imagePath);
        $image->toWebp($quality);
        $image->save($outputPath);
        return $outputPath;
    }
}
