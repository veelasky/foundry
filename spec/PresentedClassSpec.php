<?php namespace spec;

use Illuminate\Database\Eloquent\Model;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Veelasky\Foundry\Presenter\BasePresenter;
use Veelasky\Foundry\Presenter\Factory\PresentableInterface;
use Veelasky\Foundry\Presenter\Factory\PresentableTrait;

class PresentedClassSpec extends ObjectBehavior
{
    function let()
    {
	    $this->beAnInstanceOf('spec\ModelStub');
    }

	public function it_should_implement_presentable_interface()
	{
		$this->shouldImplement('Veelasky\Foundry\Presenter\Factory\PresentableInterface');
	}

	public function it_should_present_the_presenter_class()
	{
		$this->present()->shouldReturnAnInstanceOf('spec\PresenterStub');
	}

	public function it_should_resolve_parents_property_from_parent_class()
	{
		$this->present()->getAttribute('username')->shouldReturn('John Doe');

		$this->present()->getAttribute('email')->shouldReturn('john.doe@example.com');
	}

	public function it_should_handle_missing_method_to_its_parents_class()
	{
		$this->present()->getTable()->shouldReturn('table_name');
	}
}

class ModelStub extends Model implements PresentableInterface {

	use PresentableTrait;

	protected $table = "table_name";

	protected $guarded = false;

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
		return 'spec\PresenterStub';
	}
}

class PresenterStub extends BasePresenter {

}