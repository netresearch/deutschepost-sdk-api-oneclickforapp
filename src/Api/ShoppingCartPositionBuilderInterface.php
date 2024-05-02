<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;

/**
 * @api
 */
interface ShoppingCartPositionBuilderInterface
{
    public static function forPageFormat(PageFormatInterface $pageFormat): ShoppingCartPositionBuilderInterface;

    /**
     * Obtain the ID of the page format that the builder was initialized with.
     */
    public function getPageFormatId(): int;

    /**
     * Obtain the collected total of all items.
     */
    public function getTotalAmount(): int;

    /**
     * Set the product code to be used for the item and its cost (contract product price).
     *
     * @param int $productId ID of the PPL sales product (ProdWS ID)
     * @param int $price Sales product price or contract product price (if available)
     */
    public function setItemDetails(int $productId, int $price): ShoppingCartPositionBuilderInterface;

    /**
     * Select an image / a motif from the image gallery (optional).
     *
     * This setting does only apply to label formats that allow images and will be ignored otherwise.
     */
    public function setImageId(int $imageId): ShoppingCartPositionBuilderInterface;

    /**
     * Set shipper address (optional).
     *
     * This setting does only apply to label formats that allow addresses and will be ignored otherwise.
     *
     * @param string $country 3-digit ISO code
     * @param string|null $lastName
     * @param string|null $firstName
     * @param string|null $salutation
     * @param string|null $title
     * @param string|null $streetAddition
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
     * Set consignee address for a shipment (optional).
     *
     * This setting does only apply to label formats that allow addresses and will be ignored otherwise.
     *
     * @param string|null $salutation
     * @param string|null $title
     * @param string|null $company
     * @param string|null $streetAddition
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
     * @param int $page page
     * @param int $column position x
     * @param int $row position y
     */
    public function setLabelPosition(int $page, int $column, int $row): ShoppingCartPositionBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the franking zone of the PDF page.
     */
    public function setVoucherLayoutFrankingZone(): ShoppingCartPositionBuilderInterface;

    /**
     * Specify that the stamp should be positioned in the address zone of the PDF page.
     */
    public function setVoucherLayoutAddressZone(): ShoppingCartPositionBuilderInterface;

    /**
     * Create the order item and reset the builder data.
     *
     * @return object
     */
    public function create();
}
