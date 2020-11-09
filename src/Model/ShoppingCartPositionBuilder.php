<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;
use DeutschePost\Sdk\OneClickForApp\Api\ShoppingCartPositionBuilderInterface;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\Address;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\AddressBinding;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\CompanyName;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\Name;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\NamedAddress;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\PersonName;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShoppingCartPDFPosition;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\VoucherLayout;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\VoucherPosition;

final class ShoppingCartPositionBuilder implements ShoppingCartPositionBuilderInterface
{
    /**
     * @var PageFormatInterface
     */
    private $pageFormat;

    /**
     * @var VoucherPositionCalculator
     */
    private $voucherPositionCalculator;

    /**
     * The amounts collected for all added items.
     *
     * @var int[]
     */
    private $itemPrices;

    /**
     * The collected data used to build the request
     *
     * @var mixed[]
     */
    private $data = [];

    private function __construct(PageFormatInterface $pageFormat, VoucherPositionCalculator $voucherPositionCalculator)
    {
        $this->pageFormat = $pageFormat;
        $this->voucherPositionCalculator = $voucherPositionCalculator;
        $this->itemPrices = [];
    }

    public static function forPageFormat(PageFormatInterface $pageFormat): ShoppingCartPositionBuilderInterface
    {
        return new static($pageFormat, new VoucherPositionCalculator());
    }

    public function getPageFormatId(): int
    {
        return $this->pageFormat->getId();
    }

    public function getTotalAmount(): int
    {
        return (int) array_sum($this->itemPrices);
    }

    public function setItemDetails(int $productId, int $price): ShoppingCartPositionBuilderInterface
    {
        $this->data['itemDetails']['productId'] = $productId;
        $this->itemPrices[] = $price;

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
        $this->data['shipper']['company'] = $company;
        $this->data['shipper']['country'] = $country;
        $this->data['shipper']['postalCode'] = $postalCode;
        $this->data['shipper']['city'] = $city;
        $this->data['shipper']['streetName'] = $streetName;
        $this->data['shipper']['streetNumber'] = $streetNumber;
        $this->data['shipper']['lastName'] = $lastName;
        $this->data['shipper']['firstName'] = $firstName;
        $this->data['shipper']['salutation'] = $salutation;
        $this->data['shipper']['title'] = $title;
        $this->data['shipper']['streetAddition'] = $streetAddition;

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
        $this->data['recipient']['lastName'] = $lastName;
        $this->data['recipient']['firstName'] = $firstName;
        $this->data['recipient']['country'] = $country;
        $this->data['recipient']['postalCode'] = $postalCode;
        $this->data['recipient']['city'] = $city;
        $this->data['recipient']['streetName'] = $streetName;
        $this->data['recipient']['streetNumber'] = $streetNumber;
        $this->data['recipient']['salutation'] = $salutation;
        $this->data['recipient']['title'] = $title;
        $this->data['recipient']['company'] = $company;
        $this->data['recipient']['streetAddition'] = $streetAddition;

        return $this;
    }

    public function setLabelPosition(int $page, int $column, int $row): ShoppingCartPositionBuilderInterface
    {
        $this->data['layout']['page'] = $page;
        $this->data['layout']['positionX'] = $column;
        $this->data['layout']['positionY'] = $row;

        return $this;
    }

    public function setVoucherLayoutFrankingZone(): ShoppingCartPositionBuilderInterface
    {
        $this->data['layout']['zone'] = VoucherLayout::FRANKING_ZONE;

        return $this;
    }

    public function setVoucherLayoutAddressZone(): ShoppingCartPositionBuilderInterface
    {
        $this->data['layout']['zone'] = VoucherLayout::ADDRESS_ZONE;

        return $this;
    }

    private function createAddress(array $data): NamedAddress
    {
        $name = new Name();
        $person = null;
        $company = null;

        if (!empty($data['lastName'])) {
            // person information available
            $person = new PersonName(
                $data['firstName'] ?? '',
                $data['lastName']
            );
            $person->setSalutation($data['salutation'] ?? '');
            $person->setTitle($data['title'] ?? '');
        }

        if (!empty($data['company'])) {
            // company information available
            $company = new CompanyName($data['company']);
            if ($person) {
                $company->setPersonName($person);
            }
        }

        if ($company) {
            // either company, optionally with person
            $name->setCompanyName($company);
        } else {
            // or person only
            $name->setPersonName($person);
        }

        $address = new Address(
            $data['streetName'],
            $data['streetNumber'],
            $data['postalCode'],
            $data['city'],
            $data['country']
        );
        $address->setAdditional($data['streetAddition'] ?? '');
        return new NamedAddress($name, $address);
    }

    public function create()
    {
        if (isset($this->data['layout'], $this->data['layout']['page'])) {
            $voucherPosition = new VoucherPosition(
                $this->data['layout']['positionX'],
                $this->data['layout']['positionY'],
                $this->data['layout']['page']
            );
        } else {
            $voucherPosition = $this->voucherPositionCalculator->getVoucherPosition(
                $this->pageFormat->getColumns(),
                $this->pageFormat->getRows(),
                count($this->itemPrices)
            );
        }

        $cartPosition = new ShoppingCartPDFPosition(
            $this->data['itemDetails']['productId'],
            $this->data['layout']['zone'] ?? VoucherLayout::DEFAULT,
            $voucherPosition
        );

        if ($this->pageFormat->isImagePossible() && isset($this->data['itemDetails']['imageId'])) {
            $cartPosition->setImageID($this->data['itemDetails']['imageId']);
        }

        if ($this->pageFormat->isAddressPossible() && isset($this->data['shipper'], $this->data['recipient'])) {
            // schema allows setting both or none
            $sender = $this->createAddress($this->data['shipper']);
            $receiver = $this->createAddress($this->data['recipient']);

            $address = new AddressBinding($sender, $receiver);
            $cartPosition->setAddress($address);
        }

        return $cartPosition;
    }
}
