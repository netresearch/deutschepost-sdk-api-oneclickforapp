<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class ShoppingCartPosition
{

    /**
     * @var ProductCode $productCode
     */
    protected $productCode = null;

    /**
     * @var ImageID $imageID
     */
    protected $imageID = null;

    /**
     * @var AddressBinding $address
     */
    protected $address = null;

    /**
     * @var string $additionalInfo
     */
    protected $additionalInfo = null;

    /**
     * @var VoucherLayout $voucherLayout
     */
    protected $voucherLayout = null;

    /**
     * @param ProductCode $productCode
     * @param VoucherLayout $voucherLayout
     */
    public function __construct($productCode, $voucherLayout)
    {
      $this->productCode = $productCode;
      $this->voucherLayout = $voucherLayout;
    }

    /**
     * @return ProductCode
     */
    public function getProductCode()
    {
      return $this->productCode;
    }

    /**
     * @param ProductCode $productCode
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPosition
     */
    public function setProductCode($productCode)
    {
      $this->productCode = $productCode;
      return $this;
    }

    /**
     * @return ImageID
     */
    public function getImageID()
    {
      return $this->imageID;
    }

    /**
     * @param ImageID $imageID
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPosition
     */
    public function setImageID($imageID)
    {
      $this->imageID = $imageID;
      return $this;
    }

    /**
     * @return AddressBinding
     */
    public function getAddress()
    {
      return $this->address;
    }

    /**
     * @param AddressBinding $address
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPosition
     */
    public function setAddress($address)
    {
      $this->address = $address;
      return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo()
    {
      return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPosition
     */
    public function setAdditionalInfo($additionalInfo)
    {
      $this->additionalInfo = $additionalInfo;
      return $this;
    }

    /**
     * @return VoucherLayout
     */
    public function getVoucherLayout()
    {
      return $this->voucherLayout;
    }

    /**
     * @param VoucherLayout $voucherLayout
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\ShoppingCartPosition
     */
    public function setVoucherLayout($voucherLayout)
    {
      $this->voucherLayout = $voucherLayout;
      return $this;
    }

}
