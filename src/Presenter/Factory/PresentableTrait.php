<?php namespace Veelasky\Foundry\Presenter\Factory;
/**
 * Presentable Traits
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

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
} 