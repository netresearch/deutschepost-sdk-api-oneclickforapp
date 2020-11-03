<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api\Data;

/**
 * @api
 */
interface VoucherInterface
{
    /**
     * Use the sequence number to associate the voucher with a request position.
     *
     * @return string
     */
    public function getSequenceNumber(): string;

    /**
     * Obtain the generated voucher id.
     *
     * @return string
     */
    public function getVoucherId(): string;

    /**
     * Obtain the track id for international shipments.
     *
     * @return string|null
     */
    public function getTrackId(): ?string;

    /**
     * Obtain the PDF label binary for the item.
     *
     * @return string
     */
    public function getLabel(): string;
}
