<?php namespace Veelasky\Foundry\Database\Parentable;
/**
 * Parentable trait
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use DB;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ParentableTrait {

	/**
	 * define has many relations to current table
	 *
	 * @throws \Veelasky\Foundry\Database\Parentable\Exceptions\InvalidAttributeException
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children()
	{
		if (! in_array('parent', $this->attributes))
			throw new Exceptions\InvalidAttributeException($this);

		return new HasMany(
			$this->newQuery()->orderBy(DB::raw("COALESCE((SELECT NULLIF(".$this->getTable() . "." . "parent".",0)), ".$this->getTable() . ".". $this->getKeyName() .")")),
			$this,
			$this->getTable() . "." . "parent",
			$this->getKeyName()
		);
	}
} 