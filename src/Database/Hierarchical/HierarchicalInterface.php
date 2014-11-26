<?php namespace Veelasky\Foundry\Database\Hierarchical;
/**
 * Hierarchical interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface HierarchicalInterface {

	/**
	 * define has many relations to current table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children();
} 