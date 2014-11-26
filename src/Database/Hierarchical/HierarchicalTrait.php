<?php namespace Veelasky\Foundry\Database\Hierarchical;
/**
 * Hierarchical trait
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HierarchicalTrait {

	/**
	 * define has many relations to current table
	 *
	 * @throws \Veelasky\Foundry\Database\Hierarchical\Exceptions\InvalidAttributeException
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children()
	{
		if (! in_array('parent', $this->attributes) OR ! in_array('order', $this->attributes))
			throw new Exceptions\InvalidAttributeException($this);

		$hasMany = new HasMany(
			$this->newQuery(),
			$this,
			$this->getTable() . "." . "parent",
			$this->getKeyName()
		);

		return $hasMany->orderBy(new Expression("COALESCE((SELECT NULLIF(".$this->getTable() . ".parent".",0)), ".$this->getTable() . ".order)"));
	}
} 