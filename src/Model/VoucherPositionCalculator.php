<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\RequestType\VoucherPosition;

class VoucherPositionCalculator
{
    public function getVoucherPosition(int $pageColumns, int $pageRows, int $itemNumber): VoucherPosition
    {
        $itemsPerPage = $pageColumns * $pageRows;
        $page = (int) ceil($itemNumber / $itemsPerPage);

        $column = $itemNumber % $pageColumns;
        $column = $column ?: $pageColumns;

        if ($itemNumber > $itemsPerPage) {
            $itemNumber -= (($page - 1) * $itemsPerPage);
        }

        $row = (int) ceil($itemNumber / $pageColumns);

        return new VoucherPosition($column, $row, $page);
    }
}
