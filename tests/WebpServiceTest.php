<?php

namespace Alimi7372\WebpConvertor\Tests;

use Alimi7372\WebpConvertor\WebpService;
use Orchestra\Testbench\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WebpServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Alimi7372\WebpConvertor\WebpServiceProvider::class,
        ];
    }
    protected WebpService $webpService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->webpService = new WebpService();
        Storage::fake('public');
    }

    /** @test */
    public function it_can_convert_image_to_webp()
    {
        $image = UploadedFile::fake()->image('test.jpg', 600, 600);
        $outputPath = Storage::disk('public')->path('test.webp');
        $this->webpService->convert($image->getRealPath(), $outputPath);
        $this->assertFileExists($outputPath);
        $this->assertEquals('image/webp', mime_content_type($outputPath));
    }

    /** @test */
    public function it_can_compress_image_while_converting()
    {
        $image = UploadedFile::fake()->image('test.jpg', 1200, 1200);
        $outputPath = Storage::disk('public')->path('test_compressed.webp');
        $this->webpService->convert($image->getRealPath(), $outputPath, 50);
        $this->assertFileExists($outputPath);
        $this->assertEquals('image/webp', mime_content_type($outputPath));
        $originalSize = filesize($image->getRealPath());
        $compressedSize = filesize($outputPath);
        $this->assertLessThan($originalSize, $compressedSize, 'The compressed file should be smaller than the original.');
    }
}
