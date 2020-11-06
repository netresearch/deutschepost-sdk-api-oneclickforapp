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

    public function __construct(PersonName $personName, CompanyName $companyName)
    {
        $this->personName = $personName;
        $this->companyName = $companyName;
    }
}
