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
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $walletBalance;

    /**
     * @var string
     */
    private $label;

    /**
     * @var VoucherInterface[]
     */
    private $vouchers;

    /**
     * @var string|null
     */
    private $manifest;

    /**
     * @param string $id
     * @param int $walletBalance
     * @param string $label
     * @param VoucherInterface[] $vouchers
     * @param string|null $manifest
     */
    public function __construct(string $id, int $walletBalance, string $label, array $vouchers, ?string $manifest)
    {
        $this->id = $id;
        $this->walletBalance = $walletBalance;
        $this->label = $label;
        $this->vouchers = $vouchers;
        $this->manifest = $manifest;
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
