<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;

class ContractProduct implements ContractProductInterface
{
    public function __construct(private int $id, private int $price)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
