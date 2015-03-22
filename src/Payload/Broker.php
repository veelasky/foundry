<?php  namespace Veelasky\Foundry\Payload; 
/**
 * 
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use Veelasky\Foundry\Payload\Contracts\Payload as PayloadContract;

class Broker implements PayloadContract {

	/**
	 * Laravel encrypter
	 *
	 * @var \Illuminate\Encryption\Encrypter $encrypter
	 */
	protected $encrypter;

	/**
	 * Laravel HTTP request
	 *
	 * @var \Illuminate\Http\Request $request
	 */
	protected $request;

	/**
	 * Payload encrypted value
	 *
	 * @var string $encryptedValue
	 */
	protected $encryptedValue;

	/**
	 * Payload decrypted value
	 *
	 * @var array $decryptedValue
	 */
	protected $decryptedValue = [];

	/**
	 * Payload values to be decrypted
	 *
	 * @var array $payload
	 */
	protected $payload = [];

	/**
	 * Create new payload broker
	 *
	 * @param \Illuminate\Encryption\Encrypter $encrypter
	 * @param \Illuminate\Http\Request $request
	 */
	public function __construct(Encrypter $encrypter, Request $request)
	{
		$this->encrypter    = $encrypter;
		$this->request      = $request;

		$this->setPayload('time', time());
	}

	/**
	 * Set payload
	 *
	 * @param $key
	 * @param $value
	 */
	public function setPayload($key, $value)
	{
		$this->payload[$key] = $value;
	}

	/**
	 * Get payload
	 *
	 * @param $key
	 *
	 * @return static
	 */
	public function getPayload($key)
	{
		if (array_key_exists($key, $this->payload))
		{
			$value = $this->payload[$key];

			if ($key == 'time') return Carbon::createFromTimestamp( (int) $value);

			return $value;
		}

	}

	/**
	 * Check the payload against its counterpart
	 *
	 * @param $key
	 * @param $toCheck
	 *
	 * @return bool
	 */
	public function check($key, $toCheck)
	{
		if (array_key_exists($key, $this->payload))
		{
			return ($this->payload[$key] == $toCheck);
		}
	}

	/**
	 * Create new payload from string
	 *
	 * @param $string
	 */
	public function createFromString($string)
	{
		$this->encryptedValue = $string;

		$this->decryptPayload();
	}

	/**
	 * Create new payload from input
	 *
	 * @param $name
	 */
	public function createFromInput($name)
	{
		$this->encryptedValue = $this->request->input($name);

		$this->decryptPayload();
	}

	/**
	 * Create encrypted value for payload
	 *
	 * @return string
	 */
	public function payload()
	{
		return $this->encryptPayload();
	}

	/**
	 * Attempt to decrypt payload
	 *
	 * @return void
	 */
	protected function decryptPayload()
	{
		try
		{
			$decrypted = $this->encrypter->decrypt($this->encryptedValue);
			$this->decryptedValue = json_decode($decrypted);
		} catch (\Exception $e) {
			// do nothing;
		}
	}

	/**
	 * Encrypt payload
	 *
	 * @return string
	 */
	protected function encryptPayload()
	{
		$payload = json_encode($this->payload);

		return $this->encrypter->encrypt($payload);
	}

	/**
	 * Convert the payload to its string implementation
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->payload();
	}

}