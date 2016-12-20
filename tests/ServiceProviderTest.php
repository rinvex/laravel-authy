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

declare(strict_types=1);

namespace Rinvex\Authy\Test;

use ReflectionClass;
use PHPUnit_Framework_TestCase;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Rinvex\Authy\Providers\AuthyServiceProvider;

class ServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /** Get the service provider class. */
    protected function getServiceProviderClass(): string
    {
        return AuthyServiceProvider::class;
    }

    /** @test */
    public function it_is_a_service_provider()
    {
        $class = $this->getServiceProviderClass();

        $reflection = new ReflectionClass($class);

        $provider = new ReflectionClass(ServiceProvider::class);

        $msg = "Expected class '$class' to be a service provider.";

        $this->assertTrue($reflection->isSubclassOf($provider), $msg);
    }

    /** @test */
    public function it_has_provides_method()
    {
        $class = $this->getServiceProviderClass();
        $reflection = new ReflectionClass($class);

        $method = $reflection->getMethod('provides');
        $method->setAccessible(true);

        $msg = "Expected class '$class' to provide a valid list of services.";

        $this->assertInternalType('array', $method->invoke(new $class(new Container())), $msg);
    }
}
