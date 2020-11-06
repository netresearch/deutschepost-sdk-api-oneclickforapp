<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShoppingCartPDFPosition;

class ShoppingCartPDFRequest
{
    /**
     * @var string $userToken
     */
    private $userToken;

    /**
     * @var int $pageFormatId
     */
    private $pageFormatId;

    /**
     * @var ShoppingCartPDFPosition[] $positions
     */
    private $positions;

    /**
     * @var int $total
     */
    private $total;

    /**
     * @var string|null $shopOrderId
     */
    private $shopOrderId;

    /**
     * @var int|null $ppl
     */
    private $ppl;

    /**
     * @var bool|null $createManifest
     */
    private $createManifest;

    /**
     * @var string|null $createShippingList
     */
    private $createShippingList;

    /**
     * @param string $userToken
     * @param int $pageFormatId
     * @param ShoppingCartPDFPosition[] $positions
     * @param int $total
     */
    public function __construct(string $userToken, int $pageFormatId, array $positions, int $total)
    {
      $this->userToken = $userToken;
      $this->pageFormatId = $pageFormatId;
      $this->positions = $positions;
      $this->total = $total;
    }

    public function setShopOrderId(string $shopOrderId): void
    {
      $this->shopOrderId = $shopOrderId;
    }

    public function setPpl(int $ppl): void
    {
      $this->ppl = $ppl;
    }

    /**
     * @param bool $createManifest
     */
    public function setCreateManifest(bool $createManifest): void
    {
      $this->createManifest = $createManifest;
    }

    /**
     * @param string $createShippingList
     */
    public function setCreateShippingList(string $createShippingList): void
    {
      $this->createShippingList = $createShippingList;
    }
}
