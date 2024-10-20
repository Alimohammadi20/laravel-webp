<?php

if (! function_exists('convert_to_webp')) {
    /**
     * Convert an image to WebP format
     *
     * @param string $imagePath
     * @param string $outputPath
     * @param int $quality
     * @return void
     */
    function convert_to_webp(string $imagePath, string $outputPath, int $quality = 75)
    {
        return app('webp')->convert($imagePath, $outputPath, $quality);
    }
}
