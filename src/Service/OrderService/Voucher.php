<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\OrderService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\VoucherInterface;

class Voucher implements VoucherInterface
{
    /**
     * @var string
     */
    private $voucherId;

    /**
     * @var string|null
     */
    private $trackId;

    /**
     * @var string|null
     */
    private $label;

    public function __construct(string $voucherId, ?string $trackId, ?string $label)
    {
        $this->voucherId = $voucherId;
        $this->trackId = $trackId;
        $this->label = $label;
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
