<?php

declare(strict_types=1);

namespace Rinvex\Authy\Facades;

use Illuminate\Support\Facades\Facade;

class AuthyApp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rinvex.authy.app';
    }
}
