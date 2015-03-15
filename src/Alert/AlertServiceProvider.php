<?php  namespace Veelasky\Foundry\Alert; 
/**
 * Alert service provider
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('foundry.alert', Alert::class, true);
	}

}