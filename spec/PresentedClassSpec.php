<?php namespace spec;
/**
 * Presented class specification
 *
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PresentedClassSpec extends ObjectBehavior
{
    function let()
    {
	    $this->beAnInstanceOf('spec\Stub\ModelStub');
    }

	public function it_should_implement_presentable_interface()
	{
		$this->shouldImplement('Veelasky\Foundry\Presenter\Factory\PresentableInterface');
	}

	public function it_should_present_the_presenter_class()
	{
		$this->present()->shouldReturnAnInstanceOf('spec\Stub\PresenterStub');
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