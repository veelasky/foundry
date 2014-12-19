<?php namespace Veelasky\Foundry\Presenter;
/**
 * Base Presenter class
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use ArrayAccess;
use Illuminate\Database\Eloquent\Model;
use Veelasky\Foundry\Database\Metadata\MetadataInterface;
use Veelasky\Foundry\Presenter\Factory\PresentableInterface;

abstract class BasePresenter implements ArrayAccess {

	/**
	 * Resource to be presented
	 *
	 * @var \Veelasky\Foundry\Presenter\Factory\PresentableInterface $resource
	 */
	protected $resource;

	/**
	 * Resource attributes
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * create new presenter instance
	 *
	 * @param \Veelasky\Foundry\Presenter\Factory\PresentableInterface $resource
	 */
	public function __construct(PresentableInterface $resource)
	{
		$this->resource = $resource;
		$this->setPresenterData();
	}

	/**
	 * Set presenter data
	 *
	 * @return void
	 */
	protected function setPresenterData()
	{
		if ($this->resource instanceof Model)
		{
			$this->attributes = $this->resource->getAttributes();
		}

		if ($this->resource instanceof MetadataInterface)
		{
			$metadata = $this->resource->metadata()->get();

			foreach ($metadata as $meta)
			{
				$this->attributes[$meta->{$this->resource->getMetadataKeyColumn()}] = $meta->{$this->resource->getMetadataValueColumn()};
			}
		}
	}

	/**
	 * Whether a offset exists
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset
	 * @return boolean
	 */
	public function offsetExists( $offset )
	{
		return isset($this->attributes[$offset]);
	}

	/**
	 * Offset to retrieve
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset
	 * @return mixed
	 */
	public function offsetGet( $offset )
	{
		return isset($this->attributes[$offset]) ? $this->attributes[$offset] : null;
	}

	/**
	 * Offset to set
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 */
	public function offsetSet( $offset, $value )
	{
		if (is_null($offset))
		{
			$this->attributes[] = $value;
		} else {
			$this->attributes[$offset] = $value;
		}
	}

	/**
	 * Offset to unset
	 *
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset
	 * @return void
	 */
	public function offsetUnset( $offset ) {
		unset($this->attributes[$offset]);
	}

	/**
	 * Dynamically retrieve attributes on the model
	 *
	 * @param $key
	 * @return mixed
	 */
	public function __get( $key )
	{
		return array_key_exists($key, $this->attributes)
			? $this->attributes[$key]
			: $this->resource->{$key};
	}

	/**
	 * Handle dynamic method calls
	 *
	 * @param $method
	 * @param $parameters
	 * @return mixed
	 */
	public function __call( $method, $parameters ) {
		return call_user_func_array([$this->resource, $method], $parameters);
	}

}