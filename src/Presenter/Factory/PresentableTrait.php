<?php namespace Veelasky\Foundry\Presenter\Factory;
/**
 * Presentable Traits
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use ReflectionClass;
use Illuminate\Support\Str;
use Veelasky\Foundry\Presenter\BasePresenter;

trait PresentableTrait {

	/**
	 * Presenter instance
	 *
	 * @var \Veelasky\Foundry\Presenter\BasePresenter $__presenterInstance
	 */
	protected $__presenterInstance;

	/**
	 * Present the presenter
	 *
	 * @return \Veelasky\Foundry\Presenter\BasePresenter
	 * @throws Exceptions\InvalidPresenterExceptions
	 */
	public function present()
	{
		$presenterClass = $this->getPresenterClass();

		if (! $presenterClass OR ! class_exists($presenterClass))
			throw new Exceptions\InvalidPresenterExceptions($presenterClass);

		if (! $this->__presenterInstance)
			$this->__presenterInstance = new $presenterClass($this);

		return $this->__presenterInstance;
	}

	/**
	 * Get guessed presenter class name
	 *
	 * @return string
	 */
	public function getPresenterClass()
	{
		$reflection = new ReflectionClass(__CLASS__);
		$shortName = $reflection->getShortName();

		$guessedName = str_replace('Model', '', $shortName) . "Presenter";

		return $reflection->getNamespaceName() . "\\" . $guessedName;
	}

	/**
	 * Presentable interface should act as a surrogates to the presenter class
	 *
	 * @param $method
	 * @param $parameters
	 * @return mixed
	 */
	public function handlePresenterCall($method, $parameters)
	{
		$actualMethod  = lcfirst(str_replace('present', '', $method));

		// check if it is really presenter instance, if it is, return the cached class version of it
		// and should presented the presenter class when its not.
		if ($this->__presenterInstance instanceof BasePresenter)
			return call_user_func_array([$this->__presenterInstance, $actualMethod], $parameters);

		return $this->present()->{$actualMethod}();
	}

	/**
	 * Convert the model instance to JSON.
	 *
	 * @param int $options
	 * @return string
	 */
	public function toJson($options=0)
	{
		return $this->__presenterInstance->toJson($options);
	}

	/**
	 * Handle dynamic method calls into the method.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		if (Str::startsWith($method, 'present') AND ($this instanceof PresentableInterface))
			return $this->handlePresenterCall($method, $parameters);

		return parent::__call($method, $parameters);
	}

} 