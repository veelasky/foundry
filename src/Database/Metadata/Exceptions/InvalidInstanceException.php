<?php namespace Veelasky\Foundry\Database\Metadata\Exceptions;
/**
 * Invalid Instance exception
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Exception;

class InvalidInstanceException extends Exception {

	/**
	 * Invalid instance exception
	 *
	 * @param object $instance
	 */
	public function __construct($instance)
	{
		parent::__construct("[".get_class($instance)."] must implement MetadataInterface to works.");
	}
} 