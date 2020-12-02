<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

class AuthenticateUserResponse
{
    /**
     * @var string $userToken
     */
    private $userToken;

    /**
     * @var int $walletBalance
     */
    private $walletBalance;

    /**
     * @var bool $showTermsAndConditions
     */
    private $showTermsAndConditions;

    /**
     * @var string|null $infoMessage
     */
    private $infoMessage = null;

    public function getUserToken(): string
    {
        return $this->userToken;
    }

    public function getWalletBalance(): int
    {
        return $this->walletBalance;
    }

    public function getShowTermsAndConditions(): bool
    {
        return $this->showTermsAndConditions;
    }

    public function getInfoMessage(): ?string
    {
        return $this->infoMessage;
    }
}
