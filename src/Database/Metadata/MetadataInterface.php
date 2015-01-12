<?php namespace Veelasky\Foundry\Database\Metadata;
/**
 * Entity Metadata Interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface MetadataInterface {

	/**
	 * define has many relations to metadata table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function metadata();

	/**
	 * Get metadata table name
	 *
	 * @return string
	 */
	public function getMetadataTable();

	/**
	 * Get metadata key column name
	 *
	 * @return string
	 */
	public function getMetadataKeyColumn();

	/**
	 * Get metadata foreign key
	 *
	 * @return string
	 */
	public function getMetadataForeignKey();

	/**
	 * Get metadata model instance
	 *
	 * @param array $attributes
	 * @return \Veelasky\Foundry\Database\Metadata\MetadataModel
	 * @throws Exceptions\InvalidDataException
	 */
	public function getNewMetadataInstance($attributes = []);

	/**
	 * Get metadata value column name
	 *
	 * @return string
	 */
	public function getMetadataValueColumn();

	/**
	 * should return an array of tableName, keyColumn, valueColumn, foreignKey, localKey
	 * Example:
	 * {
	 *      return ['tableName', 'keyColumn', 'valueColumn', 'foreignKey', 'localKey'];
	 * }
	 *
	 * @return array
	 */
	public function setMetadataTableAttributes();

} 