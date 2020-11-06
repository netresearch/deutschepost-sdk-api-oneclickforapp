<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class VoucherPosition
{
    /**
     * @var int $labelX
     */
    private $labelX;

    /**
     * @var int $labelY
     */
    private $labelY;

    /**
     * @var int $page
     */
    private $page;

    public function __construct(int $labelX, int $labelY, int $page)
    {
        $this->labelX = $labelX;
        $this->labelY = $labelY;
        $this->page = $page;
    }
}
