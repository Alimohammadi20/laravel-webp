<?php

namespace Alimi7372\WebpConvertor\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HelperTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Alimi7372\WebpConvertor\WebpServiceProvider::class,
        ];
    }
    /** @test */
    public function it_can_convert_image_using_helper()
    {
        Storage::fake('public');
        $imagePath = UploadedFile::fake()->image('sample.jpg')->getRealPath();
        $outputPath = Storage::disk('public')->path('sample.webp');
        convert_to_webp($imagePath, $outputPath, 80);
        $this->assertFileExists($outputPath);
        $this->assertEquals('image/webp', mime_content_type($outputPath));
    }
}

