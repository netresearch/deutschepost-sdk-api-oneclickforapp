<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShoppingCartPDFPosition;

class ShoppingCartPDFRequest
{
    private ?string $shopOrderId = null;

    private ?int $ppl = null;

    private ?bool $createManifest = null;

    private ?string $createShippingList = null;

    /**
     * @param ShoppingCartPDFPosition[] $positions
     */
    public function __construct(private string $userToken, private int $pageFormatId, private array $positions, private int $total)
    {
    }

    public function setShopOrderId(string $shopOrderId): void
    {
        $this->shopOrderId = $shopOrderId;
    }

    public function setPpl(int $ppl): void
    {
        $this->ppl = $ppl;
    }

    public function setCreateManifest(bool $createManifest): void
    {
        $this->createManifest = $createManifest;
    }

    public function setCreateShippingList(string $createShippingList): void
    {
        $this->createShippingList = $createShippingList;
    }
}
