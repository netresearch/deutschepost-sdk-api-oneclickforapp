<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ContractProductResponseType;

class RetrieveContractProductsResponse
{
    /**
     * @var ContractProductResponseType|ContractProductResponseType[] $products
     */
    private $products;

    /**
     * @return ContractProductResponseType[]
     */
    public function getProducts(): array
    {
        if (empty($this->products)) {
            return [];
        }

        if ($this->products instanceof ContractProductResponseType) {
            return [$this->products];
        }

        return $this->products;
    }
}
