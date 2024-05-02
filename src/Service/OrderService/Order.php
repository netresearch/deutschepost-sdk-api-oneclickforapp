<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\OrderService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\VoucherInterface;

class Order implements OrderInterface
{
    /**
     * @param VoucherInterface[] $vouchers
     */
    public function __construct(private string $id, private int $walletBalance, private string $label, private array $vouchers, private ?string $manifest)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWalletBalance(): int
    {
        return $this->walletBalance;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getVouchers(): array
    {
        return $this->vouchers;
    }

    public function getManifest(): ?string
    {
        return $this->manifest;
    }
}
