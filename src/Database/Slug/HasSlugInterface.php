<?php namespace Veelasky\Foundry\Database\Slug;
/**
 * Has slug interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface HasSlugInterface {

	/**
	 * Get slug attribute name
	 *
	 * @return string
	 */
	public function getSlug();

	/**
	 * Get slug from this attribute
	 *
	 * @return string
	 */
	public function getSlugFrom();

	/**
	 * Set slug attribute mutator
	 *
	 * @param string $slug
	 */
	public function setSlugAttribute($slug);

}