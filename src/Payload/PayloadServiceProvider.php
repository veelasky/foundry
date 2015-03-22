<?php  namespace Veelasky\Foundry\Payload; 
/**
 * Payload Service provider
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\ServiceProvider;
use Veelasky\Foundry\Payload\Contracts\Payload as PayloadContract;

class PayloadServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('foundry.payload', Broker::class, true);
		$this->app->alias('foundry.payload', PayloadContract::class);
	}

}