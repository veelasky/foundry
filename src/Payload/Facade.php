<?php  namespace Veelasky\Foundry\Payload; 
/**
 * Payload broker facade
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 *
	 * @throws \RuntimeException
	 */
	protected static function getFacadeAccessor() { return 'foundry.payload'; }

}