<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class VoucherList
{

    /**
     * @var VoucherType[] $voucher
     */
    protected $voucher = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return VoucherType[]
     */
    public function getVoucher()
    {
      return $this->voucher;
    }

    /**
     * @param VoucherType[] $voucher
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\VoucherList
     */
    public function setVoucher(array $voucher = null)
    {
      $this->voucher = $voucher;
      return $this;
    }

}
