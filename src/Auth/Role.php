<?php namespace Veelasky\Foundry\Auth;
/**
 * Basic role class
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Veelasky\Foundry\Auth\Contracts\RoleInterface;

class Role implements RoleInterface {

	/**
	 * Role Identifier
	 *
	 * @var string|null
	 */
	protected $identifier;

	/**
	 * List of available permissions for this role
	 * @var array
	 */
	protected $permissions;

	/**
	 * Crate new role instance
	 *
	 * @param null $identifier
	 * @param array $permissions
	 */
	public function  __construct($identifier = null, $permissions = [])
	{
		$this->identifier = $identifier;
		$this->permissions = $permissions;
	}

	/**
	 * Set role identifier
	 *
	 * @param $identifier
	 */
	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
	}

	/**
	 * Set role permissions
	 *
	 * @param array $permissions
	 */
	public function setPermissions(array $permissions)
	{
		if (empty($permissions)) return;

		foreach ($permissions as $permission)
		{
			if (! in_array($permission, $this->permissions))
			{
				$this->permissions[] = $permission;
			}
		}

	}

	/**
	 * Get role identifier
	 *
	 * @return string
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}

	/**
	 * Get list of permissions for this role
	 *
	 * @return array
	 */
	public function getPermissions()
	{
		return $this->permissions;
	}

}