<?php namespace Veelasky\Foundry\Auth\Contracts;
/**
 * Has roles contract
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface HasRoles {

	/**
	 * Get roles lists
	 *
	 * @return mixed
	 */
	public function getRoles();

}