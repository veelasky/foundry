<?php namespace Veelasky\Foundry\Database\Metadata;
/**
 * Metadata model
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Eloquent\Model;

class MetadataModel extends Model {

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Indicates if all mass assignment is enabled.
	 *
	 * @var bool
	 */
	protected static $unguarded = true;

}