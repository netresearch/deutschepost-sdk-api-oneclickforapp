<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap;

use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\DetailedErrorException;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFRequest;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponse;

abstract class AbstractClient
{
    /**
     * Action to authenticate a user on the system.
     *
     *
     * @throws AuthenticationErrorException
     * @throws \SoapFault
     * @throws \Exception
     */
    abstract public function authenticateUser(AuthenticateUserRequest $requestType): AuthenticateUserResponse;

    /**
     * Action to provide information on the contract products that are activated for the respective postage account.
     *
     *
     * @throws AuthenticationErrorException
     * @throws \SoapFault
     * @throws \Exception
     */
    abstract public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse;

    /**
     * Action to request valid print formats that have been created in the INTERNETMARKE application.
     *
     * @throws \SoapFault
     * @throws \Exception
     */
    abstract public function retrievePageFormats(): RetrievePageFormatsResponse;

    /**
     * Action to generate Internetmarke stamps.
     *
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     * @throws \SoapFault
     * @throws \Exception
     */
    abstract public function checkoutShoppingCartPDF(ShoppingCartPDFRequest $requestType): ShoppingCartPDFResponse;
}
