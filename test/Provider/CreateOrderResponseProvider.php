<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\Provider;

class CreateOrderResponseProvider
{
    public static function success(): string
    {
        return \file_get_contents(__DIR__ . '/_files/createOrder/CheckoutShoppingCartPDFResponse.xml');
    }

    public static function pageFormatError(): string
    {
        return \file_get_contents(__DIR__ . '/_files/createOrder/ShoppingCartValidationException.xml');
    }
}
