<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

class RetrieveContractProductsRequest
{
    public function __construct(private string $userToken)
    {
    }
}
