<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap;

use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponse;

class Client extends AbstractClient
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    public function authenticateUser(AuthenticateUserRequest $requestType): AuthenticateUserResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }

    public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }

    public function retrievePageFormats(): RetrievePageFormatsResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, []);
    }

    public function checkoutShoppingCartPDF($requestType): ShoppingCartPDFResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }
}
