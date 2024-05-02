<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

class AuthenticateUserRequest
{
    public function __construct(private string $username, private string $password)
    {
    }
}
