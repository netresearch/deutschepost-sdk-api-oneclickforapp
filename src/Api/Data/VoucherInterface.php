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
     * Obtain the generated voucher id.
     */
    public function getVoucherId(): string;

    /**
     * Obtain the track id for international shipments.
     */
    public function getTrackId(): ?string;

    /**
     * Obtain the PDF label binary for the item.
     *
     * Item labels can only be accessed when a single item page format was used for the order.
     * For page formats that contain multiple items on one page, use the order's label.
     *
     * @see OrderInterface::getLabel()
     * @return string
     */
    public function getLabel(): ?string;
}
