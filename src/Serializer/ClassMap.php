<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Serializer;

use DeutschePost\Sdk\OneClickForApp\Model;

class ClassMap
{
    /**
     * Map WSDL types to PHP classes.
     *
     * @return string[]
     */
    public static function get(): array
    {
        return [
            // request types
            'AuthenticateUserRequestType' => Model\AuthenticateUserRequest::class,
            'RetrieveContractProductsRequestType' => Model\RetrieveContractProductsRequest::class,
            'ShoppingCartPDFRequestType' => Model\ShoppingCartPDFRequest::class,
            'ShoppingCartPDFPosition' => Model\RequestType\ShoppingCartPDFPosition::class,
            'AddressBinding' => Model\RequestType\AddressBinding::class,
            'NamedAddress' => Model\RequestType\NamedAddress::class,
            'Name' => Model\RequestType\Name::class,
            'PersonName' => Model\RequestType\PersonName::class,
            'CompanyName' => Model\RequestType\CompanyName::class,
            'Address' => Model\RequestType\Address::class,
            'VoucherPosition' => Model\RequestType\VoucherPosition::class,
            'ShoppingCart' => Model\ResponseType\ShoppingCart::class,
            'VoucherList' => Model\ResponseType\VoucherList::class,
            'VoucherType' => Model\ResponseType\VoucherType::class,

            // response types
            'AuthenticateUserResponseType' => Model\AuthenticateUserResponse::class,
            'RetrievePageFormatsResponseType' => Model\RetrievePageFormatsResponse::class,
            'RetrieveContractProductsResponseType' => Model\RetrieveContractProductsResponse::class,
            'ShoppingCartResponseType' => Model\ShoppingCartPDFResponse::class,
            'PageFormat' => Model\ResponseType\PageFormat::class,
            'pageLayout' => Model\ResponseType\PageLayout::class,
            'Dimension' => Model\ResponseType\Dimension::class,
            'Position' => Model\ResponseType\Position::class,
            'BorderDimension' => Model\ResponseType\BorderDimension::class,
            'ContractProductResponseType' => Model\ResponseType\ContractProductResponseType::class,

            // @todo(nr): delete, remove
            'CreateShopOrderIdRequest' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdRequest',
            'CreateShopOrderIdResponse' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdResponse',
        ];
    }
}
