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
     */
    public function getId(): string;

    /**
     * Obtain the remaining Portokasse wallet balance.
     *
     * @return int Balance in euro cent.
     */
    public function getWalletBalance(): int;

    /**
     * Obtain the PDF label binary with all stamps created for this order.
     */
    public function getLabel(): string;

    /**
     * Obtain the vouchers created for this order.
     *
     * @return VoucherInterface[]
     */
    public function getVouchers(): array;

    /**
     * Obtain the PDF manifest binary.
     */
    public function getManifest(): ?string;
}
