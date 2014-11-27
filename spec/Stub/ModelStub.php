<?php namespace spec\Stub;
/**
 * Model Stub file for testing purpose
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Database\Eloquent\Model;
use Veelasky\Foundry\Presenter\Factory\PresentableTrait;
use Veelasky\Foundry\Presenter\Factory\PresentableInterface;

class ModelStub extends Model implements PresentableInterface {

	use PresentableTrait;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = "table_name";

	/**
	 * Indicates if all mass assignment is enabled.
	 *
	 * @var bool
	 */
	protected static $unguarded = true;

	/**
	 * The model's attributes.
	 *
	 * @var array
	 */
	protected $attributes = [
		'username'      => 'John Doe',
		'email'         => 'john.doe@example.com'
	];

	/**
	 * Get the full qualified class name for the presenter class
	 *
	 * @return string
	 */
	public function getPresenterClass() {
		return 'spec\Stub\PresenterStub';
	}
}