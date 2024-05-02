<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class ShoppingCartPDFPosition
{
    private ?\DeutschePost\Sdk\OneClickForApp\Model\RequestType\AddressBinding $address = null;

    private ?int $imageID = null;

    private ?string $additionalInfo = null;

    public function __construct(private int $productCode, private string $voucherLayout, private VoucherPosition $position)
    {
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
