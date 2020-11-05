<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class ShoppingCartPDFPosition extends ShoppingCartPosition
{

    /**
     * @var VoucherPosition $position
     */
    protected $position = null;

    /**
     * @param ProductCode $productCode
     * @param VoucherLayout $voucherLayout
     * @param VoucherPosition $position
     */
    public function __construct($productCode, $voucherLayout, $position)
    {
      parent::__construct($productCode, $voucherLayout);
      $this->position = $position;
    }

    /**
     * @return VoucherPosition
     */
    public function getPosition()
    {
      return $this->position;
    }

    /**
     * @param VoucherPosition $position
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPDFPosition
     */
    public function setPosition($position)
    {
      $this->position = $position;
      return $this;
    }

}
