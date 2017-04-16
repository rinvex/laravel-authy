<?php

declare(strict_types=1);

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
        $key = config('services.authy.secret');

        $this->app->singleton('rinvex.authy.app', function ($app) use ($httpClient, $key) {
            return new AuthyApp($httpClient, $key);
        });

        $this->app->singleton('rinvex.authy.user', function ($app) use ($httpClient, $key) {
            return new AuthyUser($httpClient, $key);
        });

        $this->app->singleton('rinvex.authy.token', function ($app) use ($httpClient, $key) {
            return new AuthyToken($httpClient, $key);
        });

        $this->app->alias('rinvex.authy.app', AuthyApp::class);
        $this->app->alias('rinvex.authy.user', AuthyUser::class);
        $this->app->alias('rinvex.authy.token', AuthyToken::class);
    }
}
