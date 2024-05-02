<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Exception\DetailedServiceException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;

/**
 * @api
 */
interface OrderServiceInterface
{
    /**
     * Create PDF labels for the given order positions.
     *
     * @param object[] $items
     *
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function createOrder(
        array $items,
        int $orderTotal,
        int $pageFormat,
        bool $createManifest = false,
        bool $createShippingList = false
    ): OrderInterface;
}
