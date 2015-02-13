<?php namespace Veelasky\Foundry\Auth;
/**
 * Auth Service Provider
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app['auth']->extend('foundry', function ($app)
		{
			$shield = new Shield(
							new EloquentUserProvider($app['hash'], $app['config']->get('auth.model')),
							$app['session.store']
						);

			$shield->setCookieJar($app['cookie']);
			$shield->setDispatcher($app['events']);
			$shield->setRequest($app->refresh('request', $shield, 'setRequest'));

			return $shield;
		});

		// register auth: extended to the application container
		$this->app['foundry.auth']  = $this->app->share(function($app) {
			$app['auth']->setDefaultDriver('foundry');

			return $app['auth'];
		});

	}

}