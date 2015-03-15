<?php  namespace Veelasky\Foundry\Alert; 
/**
 * System alerter
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Config\Repository as ConfigRepository;


class Alert extends MessageBag {

	/**
	 * Laravel session store
	 *
	 * @var \Illuminate\Session\Store $session
	 */
	protected $session;

	/**
	 * Laravel config repository
	 *
	 * @var \Illuminate\Config\Repository $config
	 */
	protected $config;

	/**
	 * Set notification session key
	 *
	 * @var string $sessionKey
	 */
	protected $sessionKey;

	/**
	 * Laravel view factory
	 *
	 * @var \Illuminate\Contracts\View\Factory
	 */
	protected $view;

	/**
	 * Validation error message bag
	 *
	 * @var array $validation
	 */
	protected $validation = [];

	/**
	 * Create new notification instance
	 *
	 * @param \Illuminate\Session\Store $session
	 * @param \Illuminate\Config\Repository $config
	 * @param \Illuminate\View\Factory $view
	 * @param array $messages
	 */
	public function __construct(Store $session, ConfigRepository $config, ViewFactory $view,  $messages =  [])
	{
		$this->session  = $session;
		$this->config   = $config;
		$this->view     = $view;
		$this->messages = $messages;

		$this->checkMessagesSession();
		$this->checkValidationSession();

		parent::__construct($messages);
	}


	/**
	 * Check if there's notification present on session store
	 *
	 * @return void
	 */
	protected function checkMessagesSession()
	{
		if ($this->session->has($this->sessionKey . "::messages"))
		{
			$this->messages = array_merge_recursive(
				$this->session->get($this->sessionKey . "::messages"),
				$this->messages
			);
		}
	}

	/**
	 * Check if there's validation error present on session store
	 *
	 * @return void
	 */
	protected function checkValidationSession()
	{
		if ($this->session->has($this->sessionKey . "::validation"))
		{
			$this->validation = $this->session->get($this->sessionKey . "::validation");
		}
	}

}