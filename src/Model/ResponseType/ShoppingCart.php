<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class ShoppingCart
{
    /**
     * @var VoucherList $voucherList
     */
    private $voucherList;

    /**
     * @var string|null $shopOrderId
     */
    private $shopOrderId;

    public function getVoucherList(): VoucherList
    {
        return $this->voucherList;
    }

    public function getShopOrderId(): ?string
    {
        return $this->shopOrderId;
    }
}
