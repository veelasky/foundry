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
	 * get slug attribute name
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return 'slug';
	}

	/**
	 * Set slug attribute mutator
	 *
	 * @param string $slug
	 */
	public function setSlugAttribute($slug)
	{
		$slug = Str::slug($slug);
		$slugCount = count( $this->newQuery()->whereRaw($this->getSlug() . " REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$this->{$this->getSlug()} = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
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
		if ($key == $this->getSlugFrom())
		{
			$this->setSlugAttribute($value);
		}

		return parent::setAttribute($key, $value);
	}

}