<?php namespace spec;
/**
 * Presenter class specification
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Stub\ModelStub;
use spec\Stub\PresenterStub;

class PresenterClassSpec extends ObjectBehavior {

	public function let()
	{
		$this->beAnInstanceOf('spec\Stub\ModelStub');
	}

	public function it_should_resolve_parents_property_from_parent_class()
	{
		$this->present()->offsetGet('username')->shouldReturn('John Doe');

		$this->present()->offsetGet('email')->shouldReturn('john.doe@example.com');
	}

	public function it_should_handle_missing_method_to_its_parents_class()
	{
		$this->present()->getTable()->shouldReturn('table_name');
	}
} 