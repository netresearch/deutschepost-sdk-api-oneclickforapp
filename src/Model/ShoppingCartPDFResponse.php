<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCart;

class ShoppingCartPDFResponse
{
    /**
     * @var string $link
     */
    private $link;

    /**
     * @var int $walletBallance
     */
    private $walletBallance;

    /**
     * @var ShoppingCart $shoppingCart
     */
    private $shoppingCart;

    /**
     * @var string|null $manifestLink
     */
    private $manifestLink;

    public function getLink(): string
    {
        return $this->link;
    }

    public function getWalletBalance(): int
    {
        return $this->walletBallance;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function getManifestLink(): ?string
    {
        return $this->manifestLink;
    }
}
