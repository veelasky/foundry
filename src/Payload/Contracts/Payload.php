<?php  namespace Veelasky\Foundry\Payload\Contracts; 
/**
 * Payload contracts interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface Payload {

	/**
	 * Set payload
	 *
	 * @param $key
	 * @param $value
	 */
	function setPayload($key, $value);

	/**
	 * Get payload
	 *
	 * @param $key
	 *
	 * @return static
	 */
	function getPayload($key);

	/**
	 * Check the payload against its counterpart
	 *
	 * @param $key
	 * @param $toCheck
	 *
	 * @return bool
	 */
	function check($key, $toCheck);

	/**
	 * Create new payload from string
	 *
	 * @param $string
	 */
	public function createFromString($string);

	/**
	 * Create new payload from input
	 *
	 * @param $name
	 */
	function createFromInput($name);

	/**
	 * Create encrypted value for payload
	 *
	 * @return string
	 */
	function payload();

}