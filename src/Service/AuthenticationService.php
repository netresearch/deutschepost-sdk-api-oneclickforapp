<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service;

use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceExceptionFactory;
use DeutschePost\Sdk\OneClickForApp\Model\AuthenticateUserRequest;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;

class AuthenticationService
{
    public function __construct(private AbstractClient $client)
    {
    }

    /**
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function authenticate(string $username, string $password): string
    {
        $request = new AuthenticateUserRequest($username, $password);

        try {
            $response = $this->client->authenticateUser($request);
            return $response->getUserToken();
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }
}
