<?php namespace Veelasky\Foundry\Presenter\Factory\Exceptions;
/**
 * Invalid Presenter Exception
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

class InvalidPresenterExceptions extends \Exception {

	/**
	 * create new exceptions instance
	 *
	 * @param string $presenterClass
	 */
	public function __construct($presenterClass)
	{
		parent::__construct("[$presenterClass] is not a valid classname");
	}
}