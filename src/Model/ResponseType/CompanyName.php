<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class CompanyName
{

    /**
     * @var string $company
     */
    protected $company = null;

    /**
     * @var PersonName $personName
     */
    protected $personName = null;

    /**
     * @param string $company
     */
    public function __construct($company)
    {
      $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
      return $this->company;
    }

    /**
     * @param string $company
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\CompanyName
     */
    public function setCompany($company)
    {
      $this->company = $company;
      return $this;
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
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\CompanyName
     */
    public function setPersonName($personName)
    {
      $this->personName = $personName;
      return $this;
    }

}
