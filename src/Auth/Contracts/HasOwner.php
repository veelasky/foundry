<?php namespace Veelasky\Foundry\Auth\Contracts;
/**
 * Has ownership contract
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface HasOwner {

	/**
	 * Get attribute that indicate ownership for this resource
	 *
	 * @return mixed
	 */
	public function getOwnerAttribute();

}