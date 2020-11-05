<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;
use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ContractProductResponseType;
use DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService\ContractProduct;

class RetrieveContractProductsResponseMapper
{
    /**
     * @param ContractProductResponseType[] $apiProducts
     * @return ContractProductInterface[]
     */
    public function map(array $apiProducts): array
    {
        return array_reduce(
            $apiProducts,
            function (array $products, ContractProductResponseType $apiProduct) {
                if ($apiProduct->getPrice() !== null) {
                    $products[] = new ContractProduct($apiProduct->getProductCode(), $apiProduct->getPrice());
                }

                return $products;
            },
            []
        );
    }
}
