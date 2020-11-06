<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\ShoppingCartPositionBuilderInterface;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShoppingCartPDFPosition;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\VoucherLayout;

final class ShoppingCartPositionBuilder implements ShoppingCartPositionBuilderInterface
{
    /**
     * @var ShoppingCartPositionBuilderInterface|null
     */
    private static $builder;

    /**
     * The total amount collected for all added items.
     *
     * @var int
     */
    private $orderTotal;

    /**
     * The collected data used to build the request
     *
     * @var mixed[]
     */
    private $data = [];

    private function __construct()
    {
        $this->orderTotal = 0;
    }

    public static function getInstance(): ShoppingCartPositionBuilderInterface
    {
        if (static::$builder === null) {
            static::$builder = new static();
        }

        return static::$builder;
    }

    public function getTotalAmount(): int
    {
        return $this->orderTotal;
    }

    public function setItemDetails(int $productId, int $price): ShoppingCartPositionBuilderInterface
    {
        $this->data['itemDetails']['productId'] = $productId;
        $this->orderTotal += $price;

        return $this;
    }

    public function setImageId(int $imageId): ShoppingCartPositionBuilderInterface
    {
        $this->data['itemDetails']['imageId'] = $imageId;

        return $this;
    }

    public function setShipperAddress(
        string $company,
        string $country,
        string $postalCode,
        string $city,
        string $streetName,
        string $streetNumber,
        string $lastName = null,
        string $firstName = null,
        string $salutation = null,
        string $title = null,
        string $streetAddition = null
    ): ShoppingCartPositionBuilderInterface {
        // TODO: Implement setShipperAddress() method.

        return $this;
    }

    public function setRecipientAddress(
        string $lastName,
        string $firstName,
        string $country,
        string $postalCode,
        string $city,
        string $streetName,
        string $streetNumber,
        string $salutation = null,
        string $title = null,
        string $company = null,
        string $streetAddition = null
    ): ShoppingCartPositionBuilderInterface {
        // TODO: Implement setRecipientAddress() method.

        return $this;
    }

    public function setLabelPosition(int $column, int $row): ShoppingCartPositionBuilderInterface
    {
        // fixme(nr): page? method call required or use sane defaults?
        $this->data['layout']['positionX'] = $column;
        $this->data['layout']['positionY'] = $row;

        return $this;
    }

    public function setVoucherLayoutFrankingZone(): ShoppingCartPositionBuilderInterface
    {
        $this->data['layout']['zone'] = VoucherLayout::FrankingZone;

        return $this;
    }

    public function setVoucherLayoutAddressZone(): ShoppingCartPositionBuilderInterface
    {
        $this->data['layout']['zone'] = VoucherLayout::AddressZone;

        return $this;
    }

    public function create()
    {
        $position = new ShoppingCartPDFPosition(
            $this->data['itemDetails']['productId'],
            $this->data['layout']['zone'] ?? VoucherLayout::__default,
            null // todo(nr): create position
        );

        $position->setImageID($this->data['itemDetails']['imageId'] ?? null);
        return $position;
    }
}
