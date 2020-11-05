<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service;

use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceExceptionFactory;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;

class AuthenticationService
{
    /**
     * @var AbstractClient
     */
    private $client;

    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $username
     * @param string $password
     * @return string
     * @throws ServiceException
     */
    public function authenticate(string $username, string $password): string
    {
        $request = new AuthenticateUserRequest($username, $password);

        try {
            $response = $this->client->authenticateUser($request);
            return $response->getUserToken();
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }
}
