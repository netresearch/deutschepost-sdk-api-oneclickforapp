<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class AddressBinding
{
    /**
     * @var NamedAddress $sender
     */
    private $sender;

    /**
     * @var NamedAddress $receiver
     */
    private $receiver;

    public function __construct(NamedAddress $sender, NamedAddress $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
    }
}
