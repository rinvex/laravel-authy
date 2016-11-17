<?php

/*
 * NOTICE OF LICENSE
 *
 * Part of the Rinvex Authy Package.
 *
 * This source file is subject to The MIT License (MIT)
 * that is bundled with this package in the LICENSE file.
 *
 * Package: Rinvex Authy Package
 * License: The MIT License (MIT)
 * Link:    https://rinvex.com
 */

namespace Rinvex\Authy\Providers;

use Rinvex\Authy\App as AuthyApp;
use Rinvex\Authy\User as AuthyUser;
use GuzzleHttp\Client as HttpClient;
use Rinvex\Authy\Token as AuthyToken;
use Illuminate\Support\ServiceProvider;

class AuthyServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $httpClient = new HttpClient();
        $mode       = config('services.authy.mode');
        $key        = config('services.authy.keys.'.$mode);

        $this->app->singleton('rinvex.authy.app', function ($app) use ($httpClient, $key, $mode) {
            return new AuthyApp($httpClient, $key, $mode);
        });

        $this->app->singleton('rinvex.authy.user', function ($app) use ($httpClient, $key, $mode) {
            return new AuthyUser($httpClient, $key, $mode);
        });

        $this->app->singleton('rinvex.authy.token', function ($app) use ($httpClient, $key, $mode) {
            return new AuthyToken($httpClient, $key, $mode);
        });

        $this->app->alias('rinvex.authy.app', AuthyApp::class);
        $this->app->alias('rinvex.authy.user', AuthyUser::class);
        $this->app->alias('rinvex.authy.token', AuthyToken::class);
    }
}
