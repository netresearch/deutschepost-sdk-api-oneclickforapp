<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

class RetrieveContractProductsRequest
{
    /**
     * @var string $userToken
     */
    private $userToken;

    public function __construct(string $userToken)
    {
        $this->userToken = $userToken;
    }
}
