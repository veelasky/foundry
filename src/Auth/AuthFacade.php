<?php namespace Veelasky\Foundry\Auth;
/**
 * Auth: Extended Facade
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\Facades\Facade;

class AuthFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'foundry.auth'; }

}