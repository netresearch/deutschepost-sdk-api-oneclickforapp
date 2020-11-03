<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api;

use DeutschePost\Sdk\OneClickForApp\Api\Data\ContractProductInterface;
use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;

/**
 * @api
 */
interface InfoServiceInterface
{
    /**
     * @return PageFormatInterface[]
     */
    public function getPageFormats(): array;

    /**
     * @return ContractProductInterface[]
     */
    public function getProductPrices(): array;
}
