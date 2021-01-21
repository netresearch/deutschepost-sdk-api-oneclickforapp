<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\Provider;

class GetPageFormatsResponseProvider
{
    public static function success(): string
    {
        return \file_get_contents(__DIR__ . '/_files/getPageFormats/retrievePageFormatsResponse.xml');
    }
}
