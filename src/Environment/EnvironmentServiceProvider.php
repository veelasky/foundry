<?php  namespace Veelasky\Foundry\Environment; 
/**
 * Environment service provider
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\ServiceProvider;

class EnvironmentServiceProvider extends ServiceProvider {

	/**
	 * Boot the provider
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../config/environment.php'       => config_path('foundry/environment.php')
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		/**
		 * @var \Illuminate\Config\Repository $configRepository
		 */
		$configRepository = $this->app['Illuminate\Config\Repository'];

		foreach ($configRepository->get('foundry.environment') as $env => $providers)
		{
			if ($this->app->environment($env) AND is_array($providers)) $this->registerProviders($providers);
		}

	}

	/**
	 * Register the service provider
	 *
	 * @param array $providers
	 */
	protected function registerProviders(array $providers)
	{
		foreach ($providers as $provider)
		{
			$this->app->register($provider);
		}
	}

}