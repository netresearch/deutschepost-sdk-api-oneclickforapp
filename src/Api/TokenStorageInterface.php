<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationStorageException;

/**
 * @api
 */
interface TokenStorageInterface
{
    /**
     * @throws AuthenticationStorageException
     */
    public function readToken(): string;

    /**
     * @param string $token Authorization token
     * @param int $lifetime Expiry time in seconds
     * @return void
     * @throws AuthenticationStorageException
     */
    public function saveToken(string $token, int $lifetime);
}
