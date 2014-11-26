<?php namespace Veelasky\Foundry\Database\Metadata\Exceptions;
/**
 * Invalid data exception
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Exception;

class InvalidDataException extends Exception {

	/**
	 * Invalid data exception
	 */
	public function __construct()
	{
		parent::__construct("setMetadataTableAttributes() method should return an array of metadata attributes.");
	}
} 