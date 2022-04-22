<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\TestCase\Service;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;
use DeutschePost\Sdk\OneClickForApp\Auth\Credentials;
use DeutschePost\Sdk\OneClickForApp\Auth\TokenStorage;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;
use DeutschePost\Sdk\OneClickForApp\Soap\SoapServiceFactory;
use DeutschePost\Sdk\OneClickForApp\Test\Expectation\CommunicationExpectation;
use DeutschePost\Sdk\OneClickForApp\Test\Provider\AuthenticationResponseProvider;
use DeutschePost\Sdk\OneClickForApp\Test\Provider\GetContractProductsResponseProvider;
use DeutschePost\Sdk\OneClickForApp\Test\Provider\GetPageFormatsResponseProvider;
use DeutschePost\Sdk\OneClickForApp\Test\TestCase\SoapServiceTestCase;
use Psr\Log\Test\TestLogger;

class AccountInformationServiceTest extends SoapServiceTestCase
{
    /**
     * Scenario: Request page formats from the web service.
     *
     * Assert that
     * - service response is a non-empty array of page formats
     * - communication gets logged with INFO severity
     *
     * @test
     * @throws \Exception
     */
    public function getPageFormats(): void
    {
        $logger = new TestLogger();
        $credentials = new Credentials('', '', 'partnerId', 'partnerKey', 1, new TokenStorage());

        $responseXml = GetPageFormatsResponseProvider::success();
        $soapClient = $this->getSoapClientMock([$responseXml]);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createAccountInformationService($credentials, $logger);
        $pageFormats = $service->getPageFormats();

        self::assertIsArray($pageFormats);
        self::assertNotEmpty($pageFormats);
        self::assertContainsOnlyInstancesOf(PageFormatInterface::class, $pageFormats);

        // Assert communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }

    /**
     * Scenario: Application credentials are wrong.
     *
     * Assert that
     * - only instances of ServiceException get thrown
     * - communication gets logged with ERROR severity
     *
     * @test
     * @throws \Exception
     */
    public function getPageFormatsAppAuthenticationError(): void
    {
        $this->expectException(ServiceException::class);

        $logger = new TestLogger();
        $credentials = new Credentials('', '', 'app', 'invalid', 1, new TokenStorage());

        $responseXml = AuthenticationResponseProvider::appVerificationFailure();
        $soapClient = $this->getSoapClientMock([$responseXml]);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createAccountInformationService($credentials, $logger);

        try {
            $service->getPageFormats();
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            $this->assertNotFalse(strpos($exception->getMessage(), 'Unknown channel'));

            throw $exception;
        }
    }

    /**
     * Scenario: Request contract products from the web service.
     *
     * Assert that
     * - service response is a non-empty array of contract products
     * - communication gets logged with INFO severity
     *
     * @test
     * @throws \Exception
     */
    public function getContractProductsSuccess(): void
    {
        $logger = new TestLogger();
        $credentials = new Credentials(
            'max.mustermann@example.com',
            'portokasse321',
            'PARTNER_ID',
            'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
            1,
            new TokenStorage()
        );

        $responseXml = [
            AuthenticationResponseProvider::userAuthSuccess(),
            GetContractProductsResponseProvider::success(),
        ];

        $soapClient = $this->getSoapClientMock($responseXml);
        $serviceFactory = new SoapServiceFactory($soapClient);

        $service = $serviceFactory->createAccountInformationService($credentials, $logger);
        $contractProducts = $service->getContractProducts();

        self::assertIsArray($contractProducts);
        self::assertNotEmpty($contractProducts);
        self::assertContainsOnlyInstancesOf(ContractProductInterface::class, $contractProducts);

        // Assert communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }


    /**
     * Scenario: Application credentials are wrong.
     *
     * Assert that
     * - only instances of ServiceException get thrown
     * - communication gets logged with ERROR severity
     *
     * @test
     * @throws \Exception
     */
    public function getContractProductsAppAuthenticationError(): void
    {
        $this->expectException(ServiceException::class);

        $logger = new TestLogger();
        $credentials = new Credentials(
            'max.mustermann@example.com',
            'portokasse321',
            'app',
            'invalid',
            1,
            new TokenStorage()
        );

        $responseXml = AuthenticationResponseProvider::appVerificationFailure();
        $soapClient = $this->getSoapClientMock([$responseXml]);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createAccountInformationService($credentials, $logger);

        try {
            $service->getContractProducts();
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            $this->assertNotFalse(strpos($exception->getMessage(), 'Unknown channel'));

            throw $exception;
        }
    }

    /**
     * Scenario: User credentials are wrong.
     *
     * Assert that
     * - only instances of ServiceException get thrown
     * - communication gets logged with ERROR severity
     *
     * @test
     * @throws \Exception
     */
    public function getContractProductsUserAuthenticationError(): void
    {
        $this->expectException(ServiceException::class);

        $logger = new TestLogger();
        $tokenStorage = new TokenStorage();
        $credentials = new Credentials(
            'max.mustermann@example.com',
            'wr0ngPa55',
            'PARTNER_ID',
            'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
            1,
            $tokenStorage
        );

        $responseXml = AuthenticationResponseProvider::userAuthFailure();
        $soapClient = $this->getSoapClientMock([$responseXml]);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createAccountInformationService($credentials, $logger);

        try {
            $service->getContractProducts();
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            $this->assertNotFalse(strpos($exception->getMessage(), 'invalid password'));

            throw $exception;
        }
    }

    /**
     * Scenario: Invalid or expired token is available in token storage, renewal successful.
     *
     * Assert that new token is stored in token storage.
     *
     * @test
     * @throws \Exception
     */
    public function getContractProductsTokenRefresh()
    {
        $oldToken = 'invalid token';
        $newToken = 'valid token';

        $logger = new TestLogger();
        $tokenStorage = new TokenStorage();
        $tokenStorage->saveToken($oldToken, 3600);
        $credentials = new Credentials(
            'max.mustermann@example.com',
            'portokasse321',
            'PARTNER_ID',
            'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
            1,
            $tokenStorage
        );

        $responseXml = [
            AuthenticationResponseProvider::expiredTokenFailure(),
            AuthenticationResponseProvider::userAuthSuccess($newToken),
            GetContractProductsResponseProvider::success(),
        ];
        $soapClient = $this->getSoapClientMock($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createAccountInformationService($credentials, $logger);

        $service->getContractProducts();

        self::assertSame($newToken, $tokenStorage->readToken());
    }
}
