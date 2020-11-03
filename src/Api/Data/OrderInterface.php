<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api\Data;

/**
 * @api
 */
interface OrderInterface
{
    /**
     * Obtain the generated order id.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Obtain the remaining Portokasse wallet balance.
     *
     * @return int Balance in euro cent.
     */
    public function getWalletBalance(): int;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string|null
     */
    public function getManifest(): ?string;

    /**
     * Obtain the ordered items.
     *
     * @return VoucherInterface[]
     */
    public function getItems(): array;
}
