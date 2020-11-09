<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class Name
{
    /**
     * @var PersonName $personName
     */
    private $personName;

    /**
     * @var CompanyName $companyName
     */
    private $companyName;

    /**
     * @param PersonName $personName
     */
    public function setPersonName(PersonName $personName): void
    {
        $this->personName = $personName;
    }

    /**
     * @param CompanyName $companyName
     */
    public function setCompanyName(CompanyName $companyName): void
    {
        $this->companyName = $companyName;
    }
}
