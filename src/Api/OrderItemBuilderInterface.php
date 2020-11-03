<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

/**
 * @api
 */
interface OrderItemBuilderInterface
{
    /**
     * Set the item identifier and product code to be used for the item and its cost (contract product price).
     *
     * @param string $itemId Unique item identifier to allocate the associated voucher in the response
     * @param int $productId ID of the PPL sales product (ProdWS ID)
     * @param int $price Sales product price or contract product price (if available)
     * @return OrderItemBuilderInterface
     */
    public function setItemDetails(string $itemId, int $productId, int $price): OrderItemBuilderInterface;

    /**
     * Select an image / a motif from the image gallery (optional).
     *
     * This setting does only apply to label formats that allow images.
     *
     * @param int $id
     * @return OrderItemBuilderInterface
     */
    public function setImageId(int $id): OrderItemBuilderInterface;

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
     * @return OrderItemBuilderInterface
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
    ): OrderItemBuilderInterface;

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
     * @return OrderItemBuilderInterface
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
    ): OrderItemBuilderInterface;

    /**
     * Specify column/row on the page (optional).
     *
     * This setting does only apply to label formats that print multiple labels on one page.
     *
     * @param int $column position x
     * @param int $row position y
     * @return OrderItemBuilderInterface
     */
    public function setLabelPosition(int $column, int $row): OrderItemBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the franking zone of the PDF page.
     *
     * @return OrderItemBuilderInterface
     */
    public function setVoucherLayoutFrankingZone(): OrderItemBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the address zone of the PDF page.
     *
     * @return OrderItemBuilderInterface
     */
    public function setVoucherLayoutAddressZone(): OrderItemBuilderInterface;

    /**
     * Create the order item and reset the builder data.
     *
     * @return object
     */
    public function create();
}
