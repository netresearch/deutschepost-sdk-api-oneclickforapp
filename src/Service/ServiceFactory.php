<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service;

use DeutschePost\Sdk\OneClickForApp\Api\AccountInformationServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\CredentialsInterface;
use DeutschePost\Sdk\OneClickForApp\Api\OrderServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Api\ServiceFactoryInterface;
use DeutschePost\Sdk\OneClickForApp\Serializer\ClassMap;
use DeutschePost\Sdk\OneClickForApp\Soap\SoapServiceFactory;
use Psr\Log\LoggerInterface;

class ServiceFactory implements ServiceFactoryInterface
{
    private const SOAP_WSDL = 'https://internetmarke.deutschepost.de/OneClickForAppV3?wsdl';

    public function createAccountInformationService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): AccountInformationServiceInterface {
        $options = [
            'trace' => 1,
            'features' => \SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
        ];

        try {
            $soapClient = new \SoapClient(self::SOAP_WSDL, $options);
        } catch (\SoapFault $soapFault) {
            throw new \RuntimeException($soapFault->getMessage(), $soapFault->getCode(), $soapFault);
        }

        $soapServiceFactory = new SoapServiceFactory($soapClient);
        return $soapServiceFactory->createAccountInformationService($credentials, $logger);
    }

    public function createOrderService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): OrderServiceInterface {
        $options = [
            'trace' => 1,
            'features' => \SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
        ];

        try {
            $soapClient = new \SoapClient(self::SOAP_WSDL, $options);
        } catch (\SoapFault $soapFault) {
            throw new \RuntimeException($soapFault->getMessage(), $soapFault->getCode(), $soapFault);
        }

        $soapServiceFactory = new SoapServiceFactory($soapClient);
        return $soapServiceFactory->createOrderService($credentials, $logger);
    }
}
