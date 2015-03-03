<?php namespace Veelasky\Foundry\Auth;
/**
 * Shield class
 * 
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Auth\Guard;
use Veelasky\Foundry\Auth\Contracts\HasOwner;
use Veelasky\Foundry\Auth\Contracts\HasRoles;
use Veelasky\Foundry\Auth\Contracts\RoleInterface;
use Veelasky\Foundry\Auth\Contracts\HasPermissions;
use Veelasky\Foundry\Auth\Contracts\Shield as ShieldContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class Shield extends Guard implements ShieldContract {

	/**
	 * List of all assigned role for this user
	 *
	 * @var array
	 */
	protected $roles = [];

	/**
	 * List of all resolved roles
	 *
	 * @var array
	 */
	protected $resolvedRoles = [];

	/**
	 * Roles and permissions resolved indicator
	 *
	 * @var bool
	 */
	protected $resolved = false;

	/**
	 * List of all combined permissions for this user
	 *
	 * @var array
	 */
	protected $permissions = [];

	/**
	 * Attach role to list of roles
	 *
	 * @param \Veelasky\Foundry\Auth\Contracts\RoleInterface $role
	 */
	public function attachRole(RoleInterface $role)
	{
		// if role is already registered on the list of roles we just need to resolve it
		if (array_key_exists($role->getIdentifier(), $this->roles))
		{
			$this->resolveRole($role);
		}

		$this->roles[$role->getIdentifier()] = $role;

		$this->resolveRole($role);
	}

	/**
	 * Resolve role
	 *
	 * @param \Veelasky\Foundry\Auth\Contracts\RoleInterface $role
	 */
	public function resolveRole(RoleInterface $role)
	{
		if (! array_key_exists($role->getIdentifier(), $this->resolvedRoles))
		{
			foreach ($role->getPermissions() as $permission)
			{
				$this->permissions[$permission][] = $role->getIdentifier();
			}

			$this->resolvedRoles[$role->getIdentifier()] = $role;
		}
	}

	/**
	 * Detach role from the list of roles
	 *
	 * @param $identifier
	 */
	public function detachRole($identifier)
	{
		$role = $this->resolvedRoles[$identifier];

		foreach ($role->getPermissions() as $permission)
		{
			$this->removePermission($permission, $role);
		}

		unset($this->resolvedRoles[$identifier]);
	}

	/**
	 * add permission to the list of permissions
	 *
	 * @param $permission
	 * @param $role
	 */
	public function setPermission($permission, $role = null)
	{
		if (! array_key_exists($permission, $this->permissions))
		{
			if ($role instanceof RoleInterface)
			{
				$this->permissions[$permission][] = $role->getIdentifier();
			} else {
				$this->permissions[$permission][] = 'Auto';
			}
		}
	}

	/**
	 * Remove permission from the list of permissions
	 *
	 * @param $permission
	 * @param null $role
	 */
	public function removePermission($permission, $role = null)
	{
		if (array_key_exists($permission, $this->permissions) AND empty($role))
		{
			unset($this->permissions[$permission]);

			return;
		} else if ( array_key_exists($permission, $this->permissions)) {
			$_permission = $this->permissions[$permission];
			$_role = ($role instanceof RoleInterface) ? $role->getIdentifier() : 'Auto';

			// determine role index
			$index = array_search($_role, $_permission);

			unset($this->permissions[$permission][$index]);

			// if it an empty array, remove it entirely
			if (count($this->permissions[$permission]) < 1)
			{
				unset ($this->permissions[$permission]);
			}
		}
	}

	/**
	 * Determine if a user has a specific roles
	 *
	 * @param $identifier
	 * @return bool
	 */
	public function hasRole($identifier)
	{
		return array_key_exists($identifier, $this->resolvedRoles);
	}

	/**
	 * Get list of roles for this user
	 *
	 * @return array
	 */
	public function roles()
	{
		return array_keys($this->resolvedRoles);
	}

	/**
	 * Determine if a user has access to a certain permission
	 *
	 * @param $permission
	 * @return bool
	 */
	public function can($permission)
	{
		if ($this->isSuperUser()) return true;

		return array_key_exists($permission, $this->permissions);
	}

	/**
	 * Determine if a user don't have any access to a certain permission
	 *
	 * @param $permission
	 * @return bool
	 */
	public function cannot($permission)
	{
		return ! $this->can($permission);
	}

	/**
	 * Determine if user is SuperUser
	 *
	 * @return bool
	 */
	public function isSuperUser()
	{
		return array_key_exists('root', $this->permissions);
	}

	/**
	 * Get all available permissions for this user
	 *
	 * @return array
	 */
	public function permissions()
	{
		return array_keys($this->permissions);
	}

	/**
	 * Determine if this user is the ownership of certain resource
	 *
	 * @param \Veelasky\Foundry\Auth\Contracts\HasOwner $resource
	 * @return bool
	 */
	public function isOwner(HasOwner $resource)
	{
		return ($this->user->getAuthIdentifier() == $resource->getOwnerAttribute());
	}

	/**
	 * Set the current user of the application.
	 *
	 * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
	 * @return void
	 */
	public function setUser(UserContract $user)
	{
		parent::setUser($user);

		$this->resetRolesAndPermissions();
		$this->setRolesAndPermissions($user);
	}

	/**
	 * Get the currently authenticated user.
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function user()
	{
		$user = parent::user();

		if ($user instanceof UserContract AND ! $this->resolved)
		{
			$this->setRolesAndPermissions($user);
		}

		return $user;
	}

	/**
	 * Set roles and permissions
	 *
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user
	 */
	public function setRolesAndPermissions(UserContract $user)
	{
		if ( $user instanceof HasPermissions )
		{
			foreach ($user->getPermissions() as $permission)
			{
				$this->setPermission($permission);
			}
		}

		if ( $user instanceof HasRoles )
		{
			foreach ($user->getRoles() as $role)
			{
				$this->attachRole($role);
			}
		}

		$this->resolved = true;
	}

	/**
	 * Reset roles and permissions data
	 *
	 * @return void
	 */
	public function resetRolesAndPermissions()
	{
		$this->roles = [];
		$this->resolvedRoles = [];
		$this->permissions = [];
		$this->resolved = false;
	}

	/**
	 * Remove the user data from the session and cookies.
	 *
	 * @return void
	 */
	protected function clearUserDataFromStorage()
	{
		parent::clearUserDataFromStorage();
		
		$this->resetRolesAndPermissions();
	}

}