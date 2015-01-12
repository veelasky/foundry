<?php  namespace Veelasky\Foundry\Database\Repository; 
/**
 * Eloquent Repository
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository {

	/**
	 * Eloquent Model used by this repository
	 *
	 * @var \Illuminate\Database\Eloquent\Model $model
	 */
	protected $model;

	/**
	 * Create new repository instance
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Set the model used by this repository
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 */
	public function setModel(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Get all records
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get record by its id
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getById($id)
	{
		return $this->getBy($this->model->getKeyName(), $id);
	}

	/**
	 * Get single record by its column value
	 *
	 * @param $column
	 * @param $value
	 * @return mixed
	 */
	public function getBy($column, $value)
	{
		return $this->model->newQuery()->where($column, $value)->first();
	}

	/**
	 * Get Record by its ID, with an exception if not found
	 *
	 * @param $id
	 * @return mixed
	 * @throws \Veelasky\Foundry\Database\Repository\Exceptions\EntityNotFoundException
	 */
	public function requireById($id)
	{
		$model = $this->getById($id);

		if ( ! $model )
			throw new Exceptions\EntityNotFoundException;

		return $model;
	}

	/**
	 * Get new instance of a model
	 *
	 * @param array $attributes
	 * @return Model|static
	 */
	public function getNewInstance($attributes = array())
	{
		return $this->model->newInstance($attributes);
	}

	/**
	 * Save current state of the model or create from an array
	 *
	 * @param $data
	 * @return mixed
	 */
	public function save($data)
	{
		if ($data instanceof Model)
		{
			return $this->storeEloquentModel($data);
		} else {
			return $this->storeArray($data);
		}
	}

	/**
	 * Update Model with data
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @param array $data
	 * @return mixed
	 */
	public function update(Model $model, $data = array())
	{
		return $model->update($data);
	}

	/**
	 * Delete record from the database
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return mixed
	 */
	public function delete(Model $model)
	{
		return $model->delete();
	}

	/**
	 * Store/save current state of the model
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @return mixed
	 */
	protected function storeEloquentModel(Model $model)
	{
		if ($model->getDirty())
		{
			return $model->save();
		} else {
			return $model->touch();
		}
	}

	/**
	 * Create new model from an array
	 *
	 * @param $data
	 * @return mixed
	 */
	protected function storeArray($data)
	{
		$model = $this->getNewInstance($data);

		return $this->storeEloquentModel($model);
	}

}