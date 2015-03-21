<?php
/**
 * Helper file for foundry authentication
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

if ( ! function_exists('shield') )
{

	/**
	 * Resolve shield instance from the container
	 *
	 * @return \Veelasky\Foundry\Auth\Shield
	 */
	function shield()
	{
		return app('auth.driver');
	}

	/**
	 * Determine if a user has access to a certain permission
	 *
	 * @param string $permission
	 * @return bool
	 */
	function can($permission)
	{
		return shield()->can($permission);
	}

	/**
	 * Determine if a user don't have any access to a certain permission
	 *
	 * @param string $permission
	 * @return bool
	 */
	function cannot($permission)
	{
		return shield()->cannot($permission);
	}

	/**
	 * Determine if a user has a specific roles
	 *
	 * @param string $identifier
	 * @return bool
	 */
	function has_role($identifier)
	{
		return shield()->hasRole($identifier);
	}

}