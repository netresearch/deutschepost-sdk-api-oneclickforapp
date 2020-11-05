<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator;

use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponse;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractDecorator;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoggerDecorator extends AbstractDecorator
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(AbstractClient $client, \SoapClient $soapClient, LoggerInterface $logger)
    {
        $this->soapClient = $soapClient;
        $this->logger = $logger;

        parent::__construct($client);
    }

    /**
     * @param \Closure $performRequest
     * @return mixed
     * @throws \Exception
     */
    private function logCommunication(\Closure $performRequest)
    {
        $logLevel = LogLevel::INFO;

        try {
            return $performRequest();
        } catch (\Exception $exception) {
            $logLevel = LogLevel::ERROR;
            throw $exception;
        } finally {
            $lastRequest = sprintf(
                "%s\n%s",
                $this->soapClient->__getLastRequestHeaders(),
                $this->soapClient->__getLastRequest()
            );

            $lastResponse = sprintf(
                "%s\n%s",
                $this->soapClient->__getLastResponseHeaders(),
                $this->soapClient->__getLastResponse()
            );

            $this->logger->log($logLevel, $lastRequest);
            $this->logger->log($logLevel, $lastResponse);

            if (isset($exception)) {
                $this->logger->log($logLevel, $exception->getMessage());
            }
        }
    }

    public function authenticateUser(AuthenticateUserRequest $requestType): AuthenticateUserResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::authenticateUser($requestType);
        };

        return $this->logCommunication($performRequest);
    }

    public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse {
        $performRequest = function () use ($requestType) {
            return parent::retrieveContractProducts($requestType);
        };

        return $this->logCommunication($performRequest);
    }

    public function retrievePageFormats(): RetrievePageFormatsResponse
    {
        $performRequest = function () {
            return parent::retrievePageFormats();
        };

        return $this->logCommunication($performRequest);
    }

    public function checkoutShoppingCartPDF($requestType)
    {
        $performRequest = function () use ($requestType) {
            return parent::checkoutShoppingCartPDF($requestType);
        };

        return $this->logCommunication($performRequest);
    }
}
