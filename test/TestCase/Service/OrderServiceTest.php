<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\TestCase\Service;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\VoucherInterface;
use DeutschePost\Sdk\OneClickForApp\Auth\Credentials;
use DeutschePost\Sdk\OneClickForApp\Auth\TokenStorage;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPositionBuilder;
use DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService\PageFormat;
use DeutschePost\Sdk\OneClickForApp\Soap\SoapServiceFactory;
use DeutschePost\Sdk\OneClickForApp\Test\Expectation\CommunicationExpectation;
use DeutschePost\Sdk\OneClickForApp\Test\Provider\AuthenticationResponseProvider;
use DeutschePost\Sdk\OneClickForApp\Test\Provider\CreateOrderResponseProvider;
use DeutschePost\Sdk\OneClickForApp\Test\TestCase\SoapServiceTestCase;
use Psr\Log\Test\TestLogger;

class OrderServiceTest extends SoapServiceTestCase
{
    public function pageFormatDataProvider(): array
    {
        return [
            [new PageFormat(1, 'DIN A4 Normalpapier', '', '', 'REGULARPAGE', 210, 297, 2, 5, true, false)]
        ];
    }

    public function wrongPageFormatDataProvider(): array
    {
        return [
            [new PageFormat(9999, 'DIN A4 Normalpapier', '', '', 'REGULARPAGE', 210, 297, 2, 5, true, false)]
        ];
    }

    /**
     * Scenario: Create an order at the web service.
     *
     * Assert that
     * - request contains parameters as set via request builder
     * - response type is correct and contains a PDF label and voucher(s)
     * - communication gets logged with INFO severity
     *
     * @test
     * @dataProvider pageFormatDataProvider
     *
     * @param PageFormat $pageFormat
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function createOrder(PageFormat $pageFormat): void
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
            CreateOrderResponseProvider::success(),
        ];

        $soapClient = $this->getSoapClientMock($responseXml);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createOrderService($credentials, $logger);

        $builder = ShoppingCartPositionBuilder::forPageFormat($pageFormat);
        $builder->setItemDetails(21, 155);
        $builder->setShipperAddress(
            $shipperCompany = 'DHL',
            $shipperCountry = 'DEU',
            $shipperPostalCode = '53113',
            $shipperCity = 'Bonn',
            $shipperStreetName = 'Charles-de-Gaulle-Straße',
            $shipperStreetNumber = '20',
            $shipperLastName = 'Doe',
            $shipperFirstName = 'John'
        );
        $builder->setRecipientAddress(
            $recipientLastName = 'Doe',
            $recipientFirstName = 'Jane',
            $recipientCountry = 'DEU',
            $recipientPostalCode = '53113',
            $recipientCity = 'Bonn',
            $recipientStreet = 'Sträßchensweg',
            $recipientStreetNumber = '2',
            null,
            null,
            $recipientCompany = 'DP'
        );

        $order = $service->createOrder(
            [$builder->create()],
            $builder->getTotalAmount(),
            $builder->getPageFormatId()
        );
        $vouchers = $order->getVouchers();

        $lastRequest = $soapClient->__getLastRequest();
        self::assertStringContainsString($shipperCompany, $lastRequest);
        self::assertStringContainsString($shipperCountry, $lastRequest);
        self::assertStringContainsString($shipperPostalCode, $lastRequest);
        self::assertStringContainsString($shipperCity, $lastRequest);
        self::assertStringContainsString($shipperStreetName, $lastRequest);
        self::assertStringContainsString($shipperStreetNumber, $lastRequest);
        self::assertStringContainsString($shipperLastName, $lastRequest);
        self::assertStringContainsString($shipperFirstName, $lastRequest);

        self::assertStringContainsString($recipientLastName, $lastRequest);
        self::assertStringContainsString($recipientFirstName, $lastRequest);
        self::assertStringContainsString($recipientCountry, $lastRequest);
        self::assertStringContainsString($recipientPostalCode, $lastRequest);
        self::assertStringContainsString($recipientCity, $lastRequest);
        self::assertStringContainsString($recipientStreet, $lastRequest);
        self::assertStringContainsString($recipientStreetNumber, $lastRequest);
        self::assertStringContainsString($recipientCompany, $lastRequest);

        self::assertInstanceOf(OrderInterface::class, $order);
        self::assertNotEmpty($order->getId());
        self::assertIsInt($order->getWalletBalance());
        self::assertStringStartsWith('%PDF-', $order->getLabel());

        self::assertNotEmpty($vouchers);
        self::assertContainsOnlyInstancesOf(VoucherInterface::class, $vouchers);
        foreach ($vouchers as $voucher) {
            self::assertNotEmpty($voucher->getVoucherId());
        }

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
     * @dataProvider pageFormatDataProvider
     *
     * @param PageFormat $pageFormat
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function createOrderAppAuthenticationError(PageFormat $pageFormat): void
    {
        $this->expectException(ServiceException::class);
        $this->expectExceptionMessageRegExp('/Unknown channel/');

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
        $service = $serviceFactory->createOrderService($credentials, $logger);

        $builder = ShoppingCartPositionBuilder::forPageFormat($pageFormat);
        $builder->setItemDetails(21, 155);
        $builder->setShipperAddress('DHL', 'DEU', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20', 'Doe', 'John');
        $builder->setRecipientAddress('Doe', 'Jane', 'DEU', '53113', 'Bonn', 'Sträßchensweg', '2', null, null, 'DP');

        try {
            $service->createOrder(
                [$builder->create()],
                $builder->getTotalAmount(),
                $builder->getPageFormatId()
            );
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

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
     * @dataProvider pageFormatDataProvider
     *
     * @param PageFormat $pageFormat
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function createOrderUserAuthenticationError(PageFormat $pageFormat): void
    {
        $this->expectException(ServiceException::class);
        $this->expectExceptionMessageRegExp('/invalid password/');

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
        $service = $serviceFactory->createOrderService($credentials, $logger);

        $builder = ShoppingCartPositionBuilder::forPageFormat($pageFormat);
        $builder->setItemDetails(21, 155);
        $builder->setShipperAddress('DHL', 'DEU', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20', 'Doe', 'John');
        $builder->setRecipientAddress('Doe', 'Jane', 'DEU', '53113', 'Bonn', 'Sträßchensweg', '2', null, null, 'DP');

        try {
            $service->createOrder(
                [$builder->create()],
                $builder->getTotalAmount(),
                $builder->getPageFormatId()
            );
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
    }


    /**
     * Scenario: Invalid or expired token is available in token storage, renewal successful.
     *
     * Assert that new token is stored in token storage.
     *
     * @test
     * @dataProvider pageFormatDataProvider
     *
     * @param PageFormat $pageFormat
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function createOrderTokenRefresh(PageFormat $pageFormat)
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
            CreateOrderResponseProvider::success(),
        ];
        $soapClient = $this->getSoapClientMock($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createOrderService($credentials, $logger);

        $builder = ShoppingCartPositionBuilder::forPageFormat($pageFormat);
        $builder->setItemDetails(21, 155);
        $builder->setShipperAddress(
            $shipperCompany = 'DHL',
            $shipperCountry = 'DEU',
            $shipperPostalCode = '53113',
            $shipperCity = 'Bonn',
            $shipperStreetName = 'Charles-de-Gaulle-Straße',
            $shipperStreetNumber = '20',
            $shipperLastName = 'Doe',
            $shipperFirstName = 'John'
        );
        $builder->setRecipientAddress(
            $recipientLastName = 'Doe',
            $recipientFirstName = 'Jane',
            $recipientCountry = 'DEU',
            $recipientPostalCode = '53113',
            $recipientCity = 'Bonn',
            $recipientStreet = 'Sträßchensweg',
            $recipientStreetNumber = '2',
            null,
            null,
            $recipientCompany = 'DP'
        );

        $service->createOrder([$builder->create()], $builder->getTotalAmount(), $builder->getPageFormatId());

        self::assertSame($newToken, $tokenStorage->readToken());
    }

    /**
     * Scenario: Requested page format is wrong.
     *
     * Assert that
     * - only instances of ServiceException get thrown
     * - communication gets logged with ERROR severity
     *
     * @test
     * @dataProvider wrongPageFormatDataProvider
     *
     * @param PageFormat $pageFormat
     * @throws ServiceException
     * @throws \ReflectionException
     */
    public function createOrderPageFormatError(PageFormat $pageFormat): void
    {
        $this->expectException(ServiceException::class);
        $this->expectExceptionMessageRegExp('/No page format with id/');

        $logger = new TestLogger();
        $tokenStorage = new TokenStorage();
        $credentials = new Credentials(
            'max.mustermann@example.com',
            'portokasse321',
            'PARTNER_ID',
            'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
            1,
            $tokenStorage
        );

        $responseXml = [
            AuthenticationResponseProvider::userAuthSuccess(),
            CreateOrderResponseProvider::pageFormatError(),
        ];

        $soapClient = $this->getSoapClientMock($responseXml);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createOrderService($credentials, $logger);

        $builder = ShoppingCartPositionBuilder::forPageFormat($pageFormat);
        $builder->setItemDetails(21, 155);
        $builder->setShipperAddress('DHL', 'DEU', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20', 'Doe', 'John');
        $builder->setRecipientAddress('Doe', 'Jane', 'DEU', '53113', 'Bonn', 'Sträßchensweg', '2', null, null, 'DP');

        try {
            $service->createOrder(
                [$builder->create()],
                $builder->getTotalAmount(),
                $builder->getPageFormatId()
            );
        } catch (ServiceException $exception) {
            // Assert communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
    }
}
