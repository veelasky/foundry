<?php namespace Veelasky\Foundry\Presenter\Factory;
/**
 * Presentable interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface PresentableInterface {

	/**
	 * prepare new Presenter instance for this resource or cached instance
	 *
	 * @return $this
	 */
	public function present();

	/**
	 * Get the full qualified class name for the presenter class
	 *
	 * @return string
	 */
	public function getPresenterClass();
} 