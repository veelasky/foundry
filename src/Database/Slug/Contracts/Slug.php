<?php namespace Veelasky\Foundry\Database\Slug\Contracts;
/**
 * Has slug interface
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

interface Slug {

	/**
	 * get slug field name
	 *
	 * @return string
	 */
	public function getSlugColumn();

	/**
	 * Get slug from this attribute
	 *
	 * @return string
	 */
	public function getSlugFromColumn();

	/**
	 * Set slug attribute mutator
	 *
	 * @param string $slug
	 */
	public function setSlugAttribute($slug);

}