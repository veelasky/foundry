<?php namespace Veelasky\Foundry\Database\Parentable;
/**
 * Parentable interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface ParentableInterface {

	/**
	 * define has many relations to current table
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children();
} 