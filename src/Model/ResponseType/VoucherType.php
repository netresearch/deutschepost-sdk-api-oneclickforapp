<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class VoucherType
{

    /**
     * @var string $voucherId
     */
    protected $voucherId = null;

    /**
     * @var string $trackId
     */
    protected $trackId = null;

    /**
     * @param string $voucherId
     */
    public function __construct($voucherId)
    {
      $this->voucherId = $voucherId;
    }

    /**
     * @return string
     */
    public function getVoucherId()
    {
      return $this->voucherId;
    }

    /**
     * @param string $voucherId
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\VoucherType
     */
    public function setVoucherId($voucherId)
    {
      $this->voucherId = $voucherId;
      return $this;
    }

    /**
     * @return string
     */
    public function getTrackId()
    {
      return $this->trackId;
    }

    /**
     * @param string $trackId
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\VoucherType
     */
    public function setTrackId($trackId)
    {
      $this->trackId = $trackId;
      return $this;
    }

}
