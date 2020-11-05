<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceException;

/**
 * @api
 */
interface AccountInformationServiceInterface
{
    /**
     * @return PageFormatInterface[]
     *
     * @throws ServiceException
     */
    public function getPageFormats(): array;

    /**
     * @return ContractProductInterface[]
     *
     * @throws ServiceException
     */
    public function getProductPrices(): array;
}
