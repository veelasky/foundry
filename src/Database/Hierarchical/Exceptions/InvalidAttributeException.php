<?php namespace Veelasky\Foundry\Database\Hierarchical\Exceptions;
/**
 * Invalid attributes name exceptions
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Exception;

class InvalidAttributeException extends Exception{

	/**
	 * Create new exception instance
	 *
	 * @param object $instance
	 */
	public function __construct($instance)
	{
		parent::__construct("[".get_class($instance)."] must have `parent` and `order` attribute.");
	}
} 