<?php

namespace Veelasky\Foundry\Auth\Contracts;

/**
 * Has Permissions contract.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface HasPermissions
{
    /**
     * Get list of permissions for this role.
     *
     * @return array
     */
    public function getPermissions();
}
