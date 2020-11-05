<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class ContractProductResponseType
{
    /**
     * @var int $productCode
     */
    private $productCode;

    /**
     * @var int|null $price
     */
    private $price;

    public function getProductCode(): int
    {
        return $this->productCode;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }
}
