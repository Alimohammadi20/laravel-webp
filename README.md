# Laravel WebP Package

This package allows you to convert images to WebP format and reduce their file size in your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require yourname/laravel-webp
```

## Usage
To convert an image to WebP format, use the following:
```php
use Alimi7372\Webp\WebpService;

app('webp')->convert($imagePath, $outputPath);
```
## Running Tests

To run the tests for this package, simply use:

```bash
composer test
```

## Facade Usage

This package includes a Facade for easier usage. You can use the `WEBP::convert()` method to convert images to WebP format.

Example:

```php
use Alimi7372\Webp\Facades\WebpFacade as WEBP;

WEBP::convert($imagePath, $outputPath, 75);
```

## Helpers

This package includes a helper function `convert_to_webp` to simplify the conversion of images to WebP format:

```php
convert_to_webp($imagePath, $outputPath, 75);
```