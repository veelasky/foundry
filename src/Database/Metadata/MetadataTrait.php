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
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 * @throws Exceptions\InvalidInstanceException
	 */
	public function metadata()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		if (! $this instanceof MetadataInterface)
			throw new Exceptions\InvalidInstanceException($this);

		$eloquent = $this->getMetadataModel();

		return new HasMany(
			$eloquent->newQuery(),
			$this,
			$this->getMetadataTable() . ".". $this->getMetadataForeignKey(),
			$this->getKeyName()
		);
	}

	/**
	 * Get metadata table name
	 *
	 * @return string
	 * @throws Exceptions\InvalidDataException
	 */
	public function getMetadataTable()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		return $this->__metadataAttributes['tableName'];
	}

	/**
	 * Get metadata table key column name
	 *
	 * @return string
	 * @throws Exceptions\InvalidDataException
	 */
	public function getMetadataKeyColumn()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		return $this->__metadataAttributes['keyColumn'];
	}

	/**
	 * Get metadata table value column name
	 *
	 * @return string
	 * @throws Exceptions\InvalidDataException
	 */
	public function getMetadataValueColumn()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		return $this->__metadataAttributes['valueColumn'];
	}

	/**
	 * Get metadata table foreign key column name
	 *
	 * @return string
	 * @throws Exceptions\InvalidDataException
	 */
	public function getMetadataForeignKey()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		return $this->__metadataAttributes['foreignKey'];
	}

	/**
	 * Get metadata model instance
	 *
	 * @return \Veelasky\Foundry\Database\Metadata\MetadataModel
	 * @throws Exceptions\InvalidDataException
	 */
	public function getMetadataModel()
	{
		if ( empty ($this->__metadataAttributes) )
			$this->validateMetadataAttribute();

		$metadataModel = new MetadataModel();
		$metadataModel->setTable($this->__metadataAttributes['tableName']);
		$metadataModel->setConnection( $this->getConnectionName() );

		return $metadataModel;
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