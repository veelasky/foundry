<?php

namespace Veelasky\Foundry\Auth\Contracts;

/*
 * Auth Shield interface
 *
 * @author      veelasky <veelasky@gmail.com>
 * @package     veelasky/foundry
 */

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;

interface Shield extends Guard
{
    /**
     * Attach role to list of roles.
     *
     * @param \Veelasky\Foundry\Auth\Contracts\RoleInterface $role
     */
    public function attachRole(RoleInterface $role);

    /**
     * Resolve role.
     *
     * @param \Veelasky\Foundry\Auth\Contracts\RoleInterface $role
     */
    public function resolveRole(RoleInterface $role);

    /**
     * Detach role from the list of roles.
     *
     * @param $identifier
     */
    public function detachRole($identifier);

    /**
     * add permission to the list of permissions.
     *
     * @param $permission
     * @param $role
     */
    public function setPermission($permission, $role = null);

    /**
     * Remove permission from the list of permissions.
     *
     * @param $permission
     * @param null $role
     */
    public function removePermission($permission, $role = null);

    /**
     * Determine if a user has a specific roles.
     *
     * @param $identifier
     *
     * @return bool
     */
    public function hasRole($identifier);

    /**
     * Get list of roles for this user.
     *
     * @return array
     */
    public function roles();

    /**
     * Determine if a user has access to a certain permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function can($permission);

    /**
     * Determine if a user don't have any access to a certain permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function cannot($permission);

    /**
     * Determine if user is SuperUser.
     *
     * @return bool
     */
    public function isSuperUser();

    /**
     * Get all available permissions for this user.
     *
     * @return array
     */
    public function permissions();

    /**
     * Determine if this user is the ownership of certain resource.
     *
     * @param \Veelasky\Foundry\Auth\Contracts\HasOwner $resource
     *
     * @return bool
     */
    public function isOwner(HasOwner $resource);

    /**
     * Set roles and permissions.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    public function setRolesAndPermissions(Authenticatable $user);

    /**
     * Reset roles and permissions data.
     */
    public function resetRolesAndPermissions();
}
