<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Soap\ClientDecorator;

use DeutschePost\Sdk\OneClickForApp\Api\Data\CredentialsInterface;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;
use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsRequest;
use DeutschePost\Sdk\OneClickForApp\Model\RetrievePageFormatsResponse;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractDecorator;

class AuthenticationDecorator extends AbstractDecorator
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * @var CredentialsInterface
     */
    private $credentials;

    public function __construct(AbstractClient $client, \SoapClient $soapClient, CredentialsInterface $credentials)
    {
        $this->soapClient = $soapClient;
        $this->credentials = $credentials;

        parent::__construct($client);
    }

    private function setAuthHeaders()
    {
        $partnerId = $this->credentials->getPartnerId();
        $keyPhase = $this->credentials->getKeyPhase();
        $key = $this->credentials->getPartnerKey();

        // The request timestamp used for authentication must be given in CE(S)T!
        $timezoneCet = new \DateTimeZone('Europe/Berlin');
        $timeCet     = new \DateTime('now', $timezoneCet);
        $date        = $timeCet->format("dmY-His");

        $signature = hash('md5', "$partnerId::$date::$keyPhase::$key");
        $signature = substr($signature, 0, 8);

        $ns = 'http://oneclickforapp.dpag.de/V3';
        $headers = [
            new \SoapHeader($ns, 'PARTNER_ID', new \SOAPVar($partnerId, XSD_STRING)),
            new \SoapHeader($ns, 'PARTNER_SIGNATURE', new \SOAPVar($signature, XSD_STRING)),
            new \SoapHeader($ns, 'REQUEST_TIMESTAMP', new \SOAPVar($date, XSD_STRING)),
            new \SoapHeader($ns, 'KEY_PHASE', new \SOAPVar($keyPhase, XSD_STRING)),
        ];

        $this->soapClient->__setSoapHeaders($headers);
    }

    public function authenticateUser(AuthenticateUserRequest $requestType): AuthenticateUserResponse
    {
        $this->setAuthHeaders();
        return parent::authenticateUser($requestType);
    }

    public function retrieveContractProducts(
        RetrieveContractProductsRequest $requestType
    ): RetrieveContractProductsResponse {
        $this->setAuthHeaders();
        return parent::retrieveContractProducts($requestType);
    }

    public function retrievePageFormats(): RetrievePageFormatsResponse
    {
        $this->setAuthHeaders();
        return parent::retrievePageFormats();
    }

    public function checkoutShoppingCartPDF($requestType)
    {
        $this->setAuthHeaders();
        return parent::checkoutShoppingCartPDF($requestType);
    }
}
