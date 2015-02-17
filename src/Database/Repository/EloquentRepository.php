<?php namespace Veelasky\Foundry\Database\Repository;
/**
 * Eloquent Repository
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository {

	/**
	 * Model used by this repository
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

}