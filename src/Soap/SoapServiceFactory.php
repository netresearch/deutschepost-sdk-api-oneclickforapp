<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap;

use DeutschePost\Sdk\OneClickForApp\Api\AccountInformationServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\CredentialsInterface;
use DeutschePost\Sdk\OneClickForApp\Api\OrderServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Api\ServiceFactoryInterface;
use DeutschePost\Sdk\OneClickForApp\Auth\TokenProvider;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService;
use DeutschePost\Sdk\OneClickForApp\Service\AuthenticationService;
use DeutschePost\Sdk\OneClickForApp\Service\OrderService;
use DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator\AuthenticationDecorator;
use DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator\ErrorHandlerDecorator;
use DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator\LoggerDecorator;
use Psr\Log\LoggerInterface;

class SoapServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    private function createAuthenticationService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): AuthenticationService {
        $pluginClient = new Client($this->soapClient);
        $pluginClient = new AuthenticationDecorator($pluginClient, $this->soapClient, $credentials);
        $pluginClient = new LoggerDecorator($pluginClient, $this->soapClient, $logger);

        return new AuthenticationService($pluginClient);
    }

    public function createAccountInformationService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): AccountInformationServiceInterface {
        $authService = $this->createAuthenticationService($credentials, $logger);
        $tokenProvider = new TokenProvider($credentials, $authService);

        $pluginClient = new Client($this->soapClient);
        $pluginClient = new ErrorHandlerDecorator($pluginClient);
        $pluginClient = new AuthenticationDecorator($pluginClient, $this->soapClient, $credentials);
        $pluginClient = new LoggerDecorator($pluginClient, $this->soapClient, $logger);

        return new AccountInformationService(
            $pluginClient,
            $tokenProvider,
            new RetrievePageFormatsResponseMapper(),
            new RetrieveContractProductsResponseMapper()
        );
    }

    public function createOrderService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): OrderServiceInterface {
        $authService = $this->createAuthenticationService($credentials, $logger);
        $tokenProvider = new TokenProvider($credentials, $authService);

        $pluginClient = new Client($this->soapClient);
        $pluginClient = new ErrorHandlerDecorator($pluginClient);
        $pluginClient = new AuthenticationDecorator($pluginClient, $this->soapClient, $credentials);
        $pluginClient = new LoggerDecorator($pluginClient, $this->soapClient, $logger);

        return new OrderService($pluginClient, $tokenProvider, new ShoppingCartPDFResponseMapper());
    }
}
