<?php

namespace Alimi7372\WebpConvertor;

use Alimi7372\WebpConvertor\Facades\WebpConvertor;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\ServiceProvider;

class WebpServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('webp-convertor', WebpService::class);
        $loader = AliasLoader::getInstance();
        $loader->alias('WebpConvertor', WebpConvertor::class);

        $this->app->singleton('webp', function ($app) {
            return new WebpService();
        });
    }

    public function boot()
    {
        parent::register();

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            __DIR__ . '/../config/webp.php' => config_path('webp.php'),
        ], 'webpconvert::config');


        UploadedFile::macro('toWebp', function ( string $output, int $quality = 80) {
            $imagePath = $this->getRealPath();
            return convert_to_webp($imagePath, $output, $quality);
        });

    }
}
