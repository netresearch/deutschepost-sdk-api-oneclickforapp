<?php

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

use DeutschePost\Sdk\OneClickForApp\Model\RetrieveContractProductsResponse;

class OneClickForAppServiceV3 extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'AuthenticateUserRequestType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\AuthenticateUserRequestType',
      'AuthenticateUserResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\AuthenticateUserResponse',
      'RetrievePageFormatsRequestType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\RetrievePageFormatsRequestType',
      'RetrievePageFormatsResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\RetrievePageFormatsResponseType',
      'PageFormat' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\PageFormat',
      'pageLayout' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\PageLayout',
      'Dimension' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Dimension',
      'Position' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Position',
      'BorderDimension' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\BorderDimension',
      'RetrieveContractProductsRequestType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\RetrieveContractProductsRequest',
      'RetrieveContractProductsResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\RetrieveContractProductsResponse',
      'ContractProductResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ContractProductResponseType',
      'CreateShopOrderIdRequest' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdRequest',
      'CreateShopOrderIdResponse' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CreateShopOrderIdResponse',
      'ShoppingCartPDFRequestType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPDFRequestType',
      'ShoppingCartResponseType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartResponseType',
      'ShoppingCartPDFPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPDFPosition',
      'ShoppingCartPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCartPosition',
      'AddressBinding' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\AddressBinding',
      'NamedAddress' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\NamedAddress',
      'Name' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Name',
      'PersonName' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\PersonName',
      'CompanyName' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\CompanyName',
      'Address' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\Address',
      'VoucherPosition' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherPosition',
      'ShoppingCart' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\ShoppingCart',
      'VoucherList' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherList',
      'VoucherType' => 'DeutschePost\\Sdk\\OneClickForApp\\Model\\ResponseType\\VoucherType',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = '/opt/wsdl2phpgenerator/wsdl/internetmarke-3.0/OneClickForAppV3.xml';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param AuthenticateUserRequestType $parameter
     * @return AuthenticateUserResponse
     */
    public function authenticateUser(AuthenticateUserRequestType $parameter)
    {
      return $this->__soapCall('authenticateUser', array($parameter));
    }

    /**
     * @param RetrievePageFormatsRequestType $parameter
     * @return RetrievePageFormatsResponseType
     */
    public function retrievePageFormats(RetrievePageFormatsRequestType $parameter)
    {
      return $this->__soapCall('retrievePageFormats', array($parameter));
    }

    /**
     * @param RetrieveContractProductsRequest $parameter
     * @return RetrieveContractProductsResponse
     */
    public function retrieveContractProducts(RetrieveContractProductsRequest $parameter)
    {
      return $this->__soapCall('retrieveContractProducts', array($parameter));
    }

    /**
     * @param CreateShopOrderIdRequest $createShopOrderIdRequest
     * @return CreateShopOrderIdResponse
     */
    public function createShopOrderId(CreateShopOrderIdRequest $createShopOrderIdRequest)
    {
      return $this->__soapCall('createShopOrderId', array($createShopOrderIdRequest));
    }

    /**
     * @param ShoppingCartPDFRequestType $parameter
     * @return ShoppingCartResponseType
     */
    public function checkoutShoppingCartPDF(ShoppingCartPDFRequestType $parameter)
    {
      return $this->__soapCall('checkoutShoppingCartPDF', array($parameter));
    }

}
