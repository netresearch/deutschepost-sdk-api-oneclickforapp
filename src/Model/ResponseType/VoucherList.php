<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class VoucherList
{
    /**
     * @var VoucherType|VoucherType[] $voucher
     */
    private $voucher;

    /**
     * @return VoucherType[]
     */
    public function getVouchers(): array
    {
        if (empty($this->voucher)) {
            return [];
        }

        if ($this->voucher instanceof VoucherType) {
            return [$this->voucher];
        }

        return $this->voucher;
    }
}
