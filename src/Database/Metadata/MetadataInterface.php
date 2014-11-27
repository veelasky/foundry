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