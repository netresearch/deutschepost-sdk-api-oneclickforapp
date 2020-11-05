<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class Name
{

    /**
     * @var PersonName $personName
     */
    protected $personName = null;

    /**
     * @var CompanyName $companyName
     */
    protected $companyName = null;

    /**
     * @param PersonName $personName
     * @param CompanyName $companyName
     */
    public function __construct($personName, $companyName)
    {
      $this->personName = $personName;
      $this->companyName = $companyName;
    }

    /**
     * @return PersonName
     */
    public function getPersonName()
    {
      return $this->personName;
    }

    /**
     * @param PersonName $personName
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Name
     */
    public function setPersonName($personName)
    {
      $this->personName = $personName;
      return $this;
    }

    /**
     * @return CompanyName
     */
    public function getCompanyName()
    {
      return $this->companyName;
    }

    /**
     * @param CompanyName $companyName
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Name
     */
    public function setCompanyName($companyName)
    {
      $this->companyName = $companyName;
      return $this;
    }

}
