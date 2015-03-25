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
	public function getSlugColumn()
	{
		return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
	}

	/**
	 * Get slug from this attribute
	 *
	 * @return string | null
	 */
	public function getSlugFromColumn()
	{
		return property_exists($this, 'slugFromColumn') ? $this->slugFromColumn : null;
	}

	/**
	 * Set slug attribute mutator
	 *
	 * @param string $slug
	 */
	public function setSlugAttribute($slug)
	{
		$slug = Str::slug($slug);
		$slugCount = count( $this->newQuery()->whereRaw($this->getSlugField() . " REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$this->{$this->getSlugField()} = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
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
		if ($key == $this->getSlugFrom() AND null !== $this->getSlugFrom())
		{
			$this->setSlugAttribute($value);
		}

		return parent::setAttribute($key, $value);
	}

}