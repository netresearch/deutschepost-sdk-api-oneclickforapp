<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\Provider;

class GetContractProductsResponseProvider
{
    public static function success(): string
    {
        return \file_get_contents(__DIR__ . '/_files/getContractProducts/retrieveContractProductsResponse.xml');
    }
}
