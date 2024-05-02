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
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFRequest;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponse;

/**
 * AbstractDecorator
 *
 * Wrapper around actual soap client to perform the following tasks:
 * - add authentication
 * - transform errors into exceptions
 * - log communication
 */
abstract class AbstractDecorator extends AbstractClient
{
    public function __construct(private AbstractClient $client)
    {
    }

    public function authenticateUser(AuthenticateUserRequest $requestType): AuthenticateUserResponse
    {
        return $this->client->authenticateUser($requestType);
    }

    public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse {
        return $this->client->retrieveContractProducts($requestType);
    }

    public function retrievePageFormats(): RetrievePageFormatsResponse
    {
        return $this->client->retrievePageFormats();
    }

    public function checkoutShoppingCartPDF(ShoppingCartPDFRequest $requestType): ShoppingCartPDFResponse
    {
        return $this->client->checkoutShoppingCartPDF($requestType);
    }
}
