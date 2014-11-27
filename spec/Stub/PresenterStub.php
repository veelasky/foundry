<?php namespace spec\Stub;
/**
 * Presenter stub for testing purpose
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Veelasky\Foundry\Presenter\BasePresenter;

class PresenterStub extends BasePresenter {

	/**
	 * return email attributes
	 *
	 * @return mixed
	 */
	public function email()
	{
		return $this->attributes['email'];
	}

	/**
	 * mutate email attribute
	 *
	 * @return mixed
	 */
	public function mutateEmail()
	{
		return str_replace('com', 'net', $this->attributes['email']);
	}
} 