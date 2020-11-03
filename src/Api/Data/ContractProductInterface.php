<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api\Data;

/**
 * @api
 */
interface ContractProductInterface
{
    /**
     * Obtain the product code (ProdWS ID).
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Obtain the contract specific product price.
     *
     * @return int Price in euro cent.
     */
    public function getPrice(): int;
}
