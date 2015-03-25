<?php namespace Veelasky\Foundry\Database\Slug;
/**
 * Trait for defining any classes with the HasSlugInterface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Support\Str;

trait HasSlug {

	/**
	 * get slug field name
	 *
	 * @return string
	 */
	protected function getSlugColumn()
	{
		return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
	}

	/**
	 * Get slug from this attribute
	 *
	 * @return string | null
	 */
	protected function getSlugFromColumn()
	{
		return property_exists($this, 'slugFromColumn') ? $this->slugFromColumn : null;
	}

	/**
	 * Set slug attribute
	 *
	 * @param string $value
	 */
	protected function setSlugColumn($value)
	{
		$slug = Str::slug($value);

		$slugCount = $this->getSlugCount($slug);

		$this->{ $this->getSlugColumn() } = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}

	/**
	 * get slug count
	 *
	 * @param  string $slug
	 *
	 * @return int
	 */
	protected function getSlugCount($slug)
	{
		return $this
			->newQuery()
			->whereRaw( $this->getSlugColumn() . " REGEXP '^{$slug}(-[0-9]*)?$'" )
			->count();
	}

	/**
	 * Set a given attribute on the model.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function setAttribute($key, $value)
	{
		if ($key == $this->getSlugFromColumn() AND null !== $value )
		{
			$this->setSlugColumn($value);
		}

		return parent::setAttribute($key, $value);
	}

}