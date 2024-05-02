<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class VoucherPosition
{
    public function __construct(private int $labelX, private int $labelY, private int $page)
    {
    }
}
