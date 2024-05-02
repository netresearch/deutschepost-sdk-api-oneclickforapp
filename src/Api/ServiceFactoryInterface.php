<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\CredentialsInterface;
use Psr\Log\LoggerInterface;

/**
 * @api
 */
interface ServiceFactoryInterface
{
    /**
     * Create the service instance to retrieve user account related information.
     *
     *
     * @throws \RuntimeException
     */
    public function createAccountInformationService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): AccountInformationServiceInterface;

    /**
     * Create the service instance to purchase INTERNETMARKE stamps.
     *
     *
     * @throws \RuntimeException
     */
    public function createOrderService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): OrderServiceInterface;
}
