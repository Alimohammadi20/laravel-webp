<?php

use Illuminate\Support\Facades\Route;
use Alimi7372\WebpConvertor\WebpService;

Route::post('/convert-to-webp', function () {
    $image = request()->file('image');
    $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    $outputPath = public_path("images/{$filename}.webp");

    app('webp')->convert($image->getRealPath(), $outputPath);

    return response()->json(['message' => 'Image converted to WebP successfully!']);
});