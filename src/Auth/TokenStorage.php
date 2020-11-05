<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Auth;

use DeutschePost\Sdk\OneClickForApp\Api\TokenStorageInterface;

/**
 * Default authentication storage implementation.
 *
 * Token will be discarded when storage object gets destroyed. To persist and re-use the token,
 * implement a custom storage (e.g. session storage, database storage).
 */
class TokenStorage implements TokenStorageInterface
{
    /**
     * @var string
     */
    private $token = '';

    /**
     * @var int Expiry unix timestamp (e.g. now + 3600)
     */
    private $expiry = 0;

    public function readToken(): string
    {
        if ($this->expiry < time()) {
            // token expired
            return '';
        }

        return $this->token;
    }

    public function saveToken(string $token, int $lifetime)
    {
        $this->expiry = time() + $lifetime;
        $this->token = $token;
    }
}
