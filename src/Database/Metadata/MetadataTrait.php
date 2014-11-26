<?php namespace Veelasky\Foundry\Database\Metadata;
/**
 * Metadata traits
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Eloquent\Relations\HasMany;

trait MetadataTrait {

	/**
	 * store an array of metadata attributes
	 *
	 * @var array;
	 */
	protected $__metadataAttributes;

	/**
	 * define has many relations to metadata table
	 *
	 * @return HasMany
	 * @throws Exceptions\InvalidInstanceException
	 */
	public function metadata()
	{
		if (! $this instanceof MetadataInterface)
			throw new Exceptions\InvalidInstanceException($this);

		if (empty($__metadataAttributes))
			$this->validateMetadataAttribute();

		$eloquent = new MetadataModel();
		$eloquent->setTable($this->__metadataAttributes['tableName']);

		return new HasMany($eloquent->newQuery(), $this, $eloquent->getTable() . ".". $this->__metadataAttributes['foreignKey'], $this->__metadataAttributes['localKey']);
	}

	/**
	 * Validate metadata attributes
	 *
	 * @throws Exceptions\InvalidDataException
	 */
	protected function validateMetadataAttribute()
	{
		$values = $this->setMetadataTableAttributes();

		if (! is_array($values))
			throw new Exceptions\InvalidDataException;

		$keys = ['tableName', 'keyColumn', 'valueColumn', 'foreignKey', 'localKey'];

		$this->__metadataAttributes = array_combine($keys, $values);
	}
} 