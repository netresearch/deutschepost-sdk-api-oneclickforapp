<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class NamedAddress
{
    public function __construct(private Name $name, private Address $address)
    {
    }
}
