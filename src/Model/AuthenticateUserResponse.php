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
    protected $userToken = null;

    /**
     * @var int $walletBalance
     */
    private $walletBalance;

    /**
     * @var boolean $showTermsAndConditions
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
