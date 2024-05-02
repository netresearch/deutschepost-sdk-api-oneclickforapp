<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class Name
{
    private ?\DeutschePost\Sdk\OneClickForApp\Model\RequestType\PersonName $personName = null;

    private ?\DeutschePost\Sdk\OneClickForApp\Model\RequestType\CompanyName $companyName = null;

    public function setPersonName(PersonName $personName): void
    {
        $this->personName = $personName;
    }

    public function setCompanyName(CompanyName $companyName): void
    {
        $this->companyName = $companyName;
    }
}
