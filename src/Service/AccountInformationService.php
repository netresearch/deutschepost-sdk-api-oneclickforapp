<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service;

use DeutschePost\Sdk\OneClickForApp\Api\AccountInformationServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Auth\TokenProvider;
use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceExceptionFactory;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;

class AccountInformationService implements AccountInformationServiceInterface
{
    public function __construct(private AbstractClient $client, private TokenProvider $tokenProvider, private RetrievePageFormatsResponseMapper $pageFormatsMapper, private RetrieveContractProductsResponseMapper $productsMapper)
    {
    }

    public function getPageFormats(): array
    {
        try {
            $response = $this->client->retrievePageFormats();
            return $this->pageFormatsMapper->map($response->getPageFormats());
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function getContractProducts(): array
    {
        $request = new RetrieveContractProductsRequest($this->tokenProvider->getToken());

        try {
            $response = $this->client->retrieveContractProducts($request);
            return $this->productsMapper->map($response->getProducts());
        } catch (AuthenticationErrorException) {
            $this->tokenProvider->resetToken();
            return $this->getContractProducts();
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }
}
