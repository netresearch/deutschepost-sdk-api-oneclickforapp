<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class VoucherType
{
    /**
     * @var string $voucherId
     */
    private $voucherId;

    /**
     * @var string|null $trackId
     */
    private $trackId;

    public function getVoucherId(): string
    {
        return $this->voucherId;
    }

    public function getTrackId(): ?string
    {
        return $this->trackId;
    }
}
