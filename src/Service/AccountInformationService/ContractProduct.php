<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;

class ContractProduct implements ContractProductInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $price;

    public function __construct(int $id, int $price)
    {
        $this->id = $id;
        $this->price = $price;
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
