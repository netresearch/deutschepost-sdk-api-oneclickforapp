<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class CompanyName
{
    /**
     * @var string $company
     */
    private $company;

    /**
     * @var PersonName $personName
     */
    protected $personName = null;

    public function __construct(string $company)
    {
        $this->company = $company;
    }

    public function setPersonName(PersonName $personName): void
    {
        $this->personName = $personName;
    }
}
