<?php

namespace Veelasky\Foundry\Auth\Contracts;

/**
 * Has roles contract.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface HasRoles
{
    /**
     * Get roles lists.
     *
     * @return mixed
     */
    public function getRoles();
}
