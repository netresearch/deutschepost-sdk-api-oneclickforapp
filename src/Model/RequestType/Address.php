<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class Address
{
    private ?string $additional = null;

    public function __construct(private string $street, private string $houseNo, private string $zip, private string $city, private string $country)
    {
    }

    public function setAdditional(string $additional): void
    {
        $this->additional = $additional;
    }
}
