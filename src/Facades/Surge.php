<?php

namespace Surge\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Surge Facade for easy access to the Surge service.
 */
class Surge extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'surge';
    }
}
