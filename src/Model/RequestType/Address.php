<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class Address
{
    /**
     * @var string $street
     */
    private $street;

    /**
     * @var string $houseNo
     */
    private $houseNo;

    /**
     * @var string $zip
     */
    private $zip;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var string|null $additional
     */
    private $additional;

    public function __construct(string $street, string $houseNo, string $zip, string $city, string $country)
    {
        $this->street = $street;
        $this->houseNo = $houseNo;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    public function setAdditional(string $additional): void
    {
        $this->additional = $additional;
    }
}
