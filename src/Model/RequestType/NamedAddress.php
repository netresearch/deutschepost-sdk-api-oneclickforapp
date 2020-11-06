<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class NamedAddress
{
    /**
     * @var Name $name
     */
    private $name;

    /**
     * @var Address $address
     */
    private $address;

    public function __construct(Name $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}
