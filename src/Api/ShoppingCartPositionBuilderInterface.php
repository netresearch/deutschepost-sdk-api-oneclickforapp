<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

/**
 * @api
 */
interface ShoppingCartPositionBuilderInterface
{
    /**
     * @return ShoppingCartPositionBuilderInterface
     */
    public static function getInstance(): ShoppingCartPositionBuilderInterface;

    /**
     * Obtain the collected total of all items.
     *
     * @return int
     */
    public function getTotalAmount(): int;

    /**
     * Set the product code to be used for the item and its cost (contract product price).
     *
     * @param int $productId ID of the PPL sales product (ProdWS ID)
     * @param int $price Sales product price or contract product price (if available)
     * @return ShoppingCartPositionBuilderInterface
     */
    public function setItemDetails(int $productId, int $price): ShoppingCartPositionBuilderInterface;

    /**
     * Select an image / a motif from the image gallery (optional).
     *
     * This setting does only apply to label formats that allow images.
     *
     * @param int $imageId
     * @return ShoppingCartPositionBuilderInterface
     */
    public function setImageId(int $imageId): ShoppingCartPositionBuilderInterface;

    /**
     * Set shipper address (conditionally mandatory).
     *
     * The shipper address can be omitted for orders with a page format that does not support addresses.
     *
     * @param string $company
     * @param string $country
     * @param string $postalCode
     * @param string $city
     * @param string $streetName
     * @param string $streetNumber
     * @param string|null $lastName
     * @param string|null $firstName
     * @param string|null $salutation
     * @param string|null $title
     * @param string|null $streetAddition
     * @return ShoppingCartPositionBuilderInterface
     */
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
    ): ShoppingCartPositionBuilderInterface;

    /**
     * Set consignee address for a shipment (conditionally mandatory).
     *
     * The recipient address can be omitted for orders with a page format that does not support addresses.
     *
     * @param string $lastName
     * @param string $firstName
     * @param string $country
     * @param string $postalCode
     * @param string $city
     * @param string $streetName
     * @param string $streetNumber
     * @param string|null $salutation
     * @param string|null $title
     * @param string|null $company
     * @param string|null $streetAddition
     * @return ShoppingCartPositionBuilderInterface
     */
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
    ): ShoppingCartPositionBuilderInterface;

    /**
     * Specify column/row on the page (optional).
     *
     * This setting does only apply to label formats that print multiple labels on one page.
     *
     * @param int $column position x
     * @param int $row position y
     * @return ShoppingCartPositionBuilderInterface
     */
    public function setLabelPosition(int $column, int $row): ShoppingCartPositionBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the franking zone of the PDF page.
     *
     * @return ShoppingCartPositionBuilderInterface
     */
    public function setVoucherLayoutFrankingZone(): ShoppingCartPositionBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the address zone of the PDF page.
     *
     * @return ShoppingCartPositionBuilderInterface
     */
    public function setVoucherLayoutAddressZone(): ShoppingCartPositionBuilderInterface;

    /**
     * Create the order item and reset the builder data.
     *
     * @return object
     */
    public function create();
}
