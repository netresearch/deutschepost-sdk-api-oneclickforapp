<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\OrderService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\VoucherInterface;

class Voucher implements VoucherInterface
{
    public function __construct(private string $voucherId, private ?string $trackId, private ?string $label)
    {
    }

    public function getVoucherId(): string
    {
        return $this->voucherId;
    }

    public function getTrackId(): ?string
    {
        return $this->trackId;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }
}
