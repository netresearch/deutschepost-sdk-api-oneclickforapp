<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class Address
{

    /**
     * @var string $additional
     */
    protected $additional = null;

    /**
     * @var string $street
     */
    protected $street = null;

    /**
     * @var string $houseNo
     */
    protected $houseNo = null;

    /**
     * @var string $zip
     */
    protected $zip = null;

    /**
     * @var string $city
     */
    protected $city = null;

    /**
     * @var string $country
     */
    protected $country = null;

    /**
     * @param string $street
     * @param string $houseNo
     * @param string $zip
     * @param string $city
     * @param string $country
     */
    public function __construct($street, $houseNo, $zip, $city, $country)
    {
      $this->street = $street;
      $this->houseNo = $houseNo;
      $this->zip = $zip;
      $this->city = $city;
      $this->country = $country;
    }

    /**
     * @return string
     */
    public function getAdditional()
    {
      return $this->additional;
    }

    /**
     * @param string $additional
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setAdditional($additional)
    {
      $this->additional = $additional;
      return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
      return $this->street;
    }

    /**
     * @param string $street
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setStreet($street)
    {
      $this->street = $street;
      return $this;
    }

    /**
     * @return string
     */
    public function getHouseNo()
    {
      return $this->houseNo;
    }

    /**
     * @param string $houseNo
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setHouseNo($houseNo)
    {
      $this->houseNo = $houseNo;
      return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
      return $this->zip;
    }

    /**
     * @param string $zip
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setZip($zip)
    {
      $this->zip = $zip;
      return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
      return $this->city;
    }

    /**
     * @param string $city
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setCity($city)
    {
      $this->city = $city;
      return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
      return $this->country;
    }

    /**
     * @param string $country
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Address
     */
    public function setCountry($country)
    {
      $this->country = $country;
      return $this;
    }

}
