<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator;

use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFRequest;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponse;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractDecorator;

class ErrorHandlerDecorator extends AbstractDecorator
{
    public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse {
        try {
            return parent::retrieveContractProducts($requestType);
        } catch (\SoapFault $fault) {
            // if identifyexception then convert to authentication error exception
            if (property_exists($fault->detail, 'IdentifyException')) {
                throw new AuthenticationErrorException($fault->getMessage());
            }

            throw $fault;
        }
    }

    public function checkoutShoppingCartPDF(ShoppingCartPDFRequest $requestType): ShoppingCartPDFResponse
    {
        try {
            return parent::checkoutShoppingCartPDF($requestType);
        } catch (\SoapFault $fault) {
            // if identifyexception then convert to authentication error exception
            if ($fault->detail) {
                throw new AuthenticationErrorException($fault->getMessage());
            }

            throw $fault;
        }
    }
}
