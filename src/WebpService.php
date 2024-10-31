<?php

namespace Alimi7372\WebpConvertor;

use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

class WebpService
{

    private ImageManager $imageManager;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        if (class_exists('Imagick')) {
            $diver = 'imagick';
        } elseif (function_exists('gd_info')) {
            $diver ='gd';
        } else {
            throw new \Exception('The selected image driver is not installed or valid.');
        }
        $this->imageManager = new ImageManager(['diver'=>$diver]);
    }
    public function convert($imagePath, $outputPath, $quality = 75)
    {
        $image = Image::make($imagePath);
        $image->encode('webp', $quality);
        $dirname = dirname($outputPath);
        if (!is_dir($dirname)){
            mkdir($dirname,777,true);
        }
        $image->save($outputPath);
        return $outputPath;
    }
}
