<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator;

use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\DetailedErrorException;
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
            if (isset($fault->detail) && property_exists($fault->detail, 'IdentifyException')) {
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
            if (isset($fault->detail) && property_exists($fault->detail, 'IdentifyException')) {
                throw new AuthenticationErrorException($fault->getMessage());
            }

            if (isset($fault->detail) && property_exists($fault->detail, 'ShoppingCartValidationException')) {
                $errors = $fault->detail->ShoppingCartValidationException->errors;
                $errors = array_map(
                    function ($error) {
                        return $error->message;
                    },
                    is_array($errors) ? $errors : [$errors]
                );
                throw new DetailedErrorException(sprintf('%s %s', $fault->getMessage(), implode(' ', $errors)));
            }

            throw $fault;
        }
    }
}
