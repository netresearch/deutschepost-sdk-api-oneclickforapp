<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class ShoppingCartPDFPosition
{
    /**
     * @var int $productCode
     */
    private $productCode;

    /**
     * @var string $voucherLayout
     */
    private $voucherLayout;

    /**
     * @var VoucherPosition $position
     */
    private $position;

    /**
     * @var AddressBinding|null $address
     */
    private $address;

    /**
     * @var int|null $imageID
     */
    private $imageID;

    /**
     * @var string|null $additionalInfo
     */
    private $additionalInfo;

    public function __construct(int $productCode, string $voucherLayout, VoucherPosition $position)
    {
        $this->productCode = $productCode;
        $this->voucherLayout = $voucherLayout;
        $this->position = $position;
    }

    public function setAddress(AddressBinding $address): void
    {
        $this->address = $address;
    }

    public function setImageID(int $imageID): void
    {
        $this->imageID = $imageID;
    }

    public function setAdditionalInfo(string $additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }
}
