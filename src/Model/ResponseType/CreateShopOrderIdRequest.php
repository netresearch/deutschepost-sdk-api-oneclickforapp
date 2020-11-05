<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class CreateShopOrderIdRequest
{

    /**
     * @var UserToken $userToken
     */
    protected $userToken = null;

    /**
     * @param UserToken $userToken
     */
    public function __construct($userToken)
    {
      $this->userToken = $userToken;
    }

    /**
     * @return UserToken
     */
    public function getUserToken()
    {
      return $this->userToken;
    }

    /**
     * @param UserToken $userToken
     * @return \DeutschePost\Sdk\OneClickForApp\Model\ResponseType\CreateShopOrderIdRequest
     */
    public function setUserToken($userToken)
    {
      $this->userToken = $userToken;
      return $this;
    }

}
