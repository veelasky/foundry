<?php

namespace Veelasky\Foundry\Auth\Contracts;

/**
 * Role interface contract.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface RoleInterface extends HasPermissions
{
    /**
     * Get role identifier.
     *
     * @return string
     */
    public function getIdentifier();
}
