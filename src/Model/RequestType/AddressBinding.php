<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class AddressBinding
{
    public function __construct(private NamedAddress $sender, private NamedAddress $receiver)
    {
    }
}
