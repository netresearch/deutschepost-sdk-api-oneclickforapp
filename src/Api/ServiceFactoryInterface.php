<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\CredentialsInterface;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;
use Psr\Log\LoggerInterface;

/**
 * @api
 */
interface ServiceFactoryInterface
{
    /**
     * Create the service instance to retrieve user account related information.
     *
     * @param CredentialsInterface $credentials
     * @param LoggerInterface $logger
     *
     * @return InfoServiceInterface
     * @throws ServiceException
     */
    public function createInfoService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): InfoServiceInterface;

    /**
     * Create the service instance to purchase INTERNETMARKE stamps.
     *
     * @param CredentialsInterface $credentials
     * @param LoggerInterface $logger
     *
     * @return OrderServiceInterface
     * @throws ServiceException
     */
    public function createOrderService(
        CredentialsInterface $credentials,
        LoggerInterface $logger
    ): OrderServiceInterface;
}
