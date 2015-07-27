<?php

namespace Veelasky\Foundry\Auth;

/*
 * Auth Service Provider
 *
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['auth']->extend('foundry', function ($app) {
            $shield = new Shield(
                new EloquentUserProvider($app['hash'], $app['config']->get('auth.model')),
                $app['session.store']
            );

            $shield->setCookieJar($app['cookie']);
            $shield->setDispatcher($app['events']);
            $shield->setRequest($app->refresh('request', $shield, 'setRequest'));

            return $shield;
        });

        // share and register foundry's auth to the application container
        // only if the default driver is set to foundry.
        if ($this->app['config']['auth.driver'] == 'foundry') {
            $this->app->alias('auth.driver', 'Veelasky\Foundry\Auth\Shield');
            $this->app->alias('auth.driver', 'Veelasky\Foundry\Auth\Contracts\Shield');

            // and a helper file to make your life easier :)

            require __DIR__.'/helper.php';
        }
    }
}
