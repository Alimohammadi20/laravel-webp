<?php

namespace Alimi7372\WebpConvertor\Facades;

use Illuminate\Support\Facades\Facade;

class WebpConvertor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'webp-convertor';
    }
}
