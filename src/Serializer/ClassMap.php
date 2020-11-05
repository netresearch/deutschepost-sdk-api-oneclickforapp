<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Serializer;

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
            'AuthenticateUserRequestType' => \DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest::class,
            'AuthenticateUserResponseType' => \DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserResponse::class,
            'RetrievePageFormatsResponseType' => \DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponse::class,
            'PageFormat' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\PageFormat::class,
            'pageLayout' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\PageLayout::class,
            'Dimension' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Dimension::class,
            'Position' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Position::class,
            'BorderDimension' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\BorderDimension::class,
            'RetrieveContractProductsRequestType' => \DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest::class,
            'RetrieveContractProductsResponseType' => \DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse::class,
            'ContractProductResponseType' => \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ContractProductResponseType::class,
            'CreateShopOrderIdRequest' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdRequest',
            'CreateShopOrderIdResponse' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdResponse',
            'ShoppingCartPDFRequestType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPDFRequestType',
            'ShoppingCartResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartResponseType',
            'ShoppingCartPDFPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPDFPosition',
            'ShoppingCartPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPosition',
            'AddressBinding' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\AddressBinding',
            'NamedAddress' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\NamedAddress',
            'Name' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Name',
            'PersonName' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\PersonName',
            'CompanyName' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CompanyName',
            'Address' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Address',
            'VoucherPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherPosition',
            'ShoppingCart' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCart',
            'VoucherList' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherList',
            'VoucherType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherType',
        ];
    }
}
