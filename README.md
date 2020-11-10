# Deutsche Post INTERNETMARKE 1C4A API SDK

The DP OneClickForApp API SDK package offers an interface to the following web services:

- OneClickForApp V3

## Requirements

### System Requirements

- PHP 7.2+ with SOAP extension

### Package Requirements

- `psr/log`: PSR-3 logger interfaces

### Development Package Requirements

- `phpunit/phpunit`: Testing framework

## Installation

```bash
$ composer require deutschepost/sdk-api-oneclickforapp
```

## Uninstallation

```bash
$ composer remove deutschepost/sdk-api-oneclickforapp
```

## Testing

```bash
$ ./vendor/bin/phpunit -c test/phpunit.xml
```

## Features

The DP OneClickForApp API SDK supports the following features:

* Retrieve page formats
* Retrieve contract products
* Create _Internetmarke_ postal stamp in PDF format

The main feature is to order _Internetmarke_ vouchers via the Deutsche Post AG
OneClickForApplication web service interface. The web service request requires
details about the ordered shipping products as well as the page dimensions of
the resulting PDF document.

The full process is outlined as follows:

* Retrieve available shipping products from the separate products web service
  ([`deutschepost/sdk-api-prodws`](https://packagist.org/packages/deutschepost/sdk-api-prodws))
* Replace general product prices by individually contracted prices ([Retrieve Contract Products](#retrieve-contract-products))
* Retrieve available print formats ([Retrieve Page Formats](#retrieve-page-formats))
* Order voucher(s) for one of the page formats, specifying one of the
  shipping products (identifier and price) per order position

The web service requires an authentication token for some operations.
The library retrieves a token but discards it after the process terminates.
In order to reuse the token, a persistent storage can be passed in
([Persist Authentication Token](#persist-authentication-token)). 

### Retrieve Page Formats

Load the list of page formats that the ordered _Internetmarke_ vouchers can be
printed on. The print formats differ in layout characteristics and come with
different capabilities.

#### Public API

The library's components suitable for consumption comprise

* services:
  * application token storage
  * service factory
  * account information service
* data transfer objects:
  * credentials
  * page format


#### Usage

```php
$logger = new \Psr\Log\Test\TestLogger();
$tokenStorage = new \DeutschePost\Sdk\OneClickForApp\Auth\TokenStorage();
$credentials = new \DeutschePost\Sdk\OneClickForApp\Auth\Credentials(
    $username = '', // page formats are public, no user auth needed
    $password = '',
    $partnerId = 'PARTNER_ID',
    $partnerKey = 'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
    $keyPhase = 1,
    $tokenStorage
);

$serviceFactory = new \DeutschePost\Sdk\OneClickForApp\Service\ServiceFactory();
$service = $serviceFactory->createAccountInformationService($credentials, $logger);
$pageFormats = $service->getPageFormats();

// work with the web service response, e.g. drop page formats that cannot print addresses
$pageFormatsWithAddress = array_filter(
    $pageFormats,
    static function (\DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface $pageFormat) {
        return $pageFormat->isAddressPossible();
    }
);
```

### Retrieve Contract Products

When ordering _Internetmarke_ vouchers, the price of the selected
shipping product must be included with the request. If the submitted product
price does not match the price list, then the web service rejects the request.

The correct price is either retrieved from the official "Produkte- und Preisliste"
(PPL) via [ProdWS API SDK](https://packagist.org/packages/deutschepost/sdk-api-prodws)
or, if available, from the user's contract.

#### Public API

The library's components suitable for consumption comprise

* services:
  * application token storage
  * service factory
  * account information service
* data transfer objects:
  * credentials
  * contract product

#### Usage

```php
$logger = new \Psr\Log\Test\TestLogger();
$tokenStorage = new \DeutschePost\Sdk\OneClickForApp\Auth\TokenStorage();
$credentials = new \DeutschePost\Sdk\OneClickForApp\Auth\Credentials(
    $username = 'max.mustermann@example.com',
    $password = 'portokasse321',
    $partnerId = 'PARTNER_ID',
    $partnerKey = 'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
    $keyPhase = 1,
    $tokenStorage
);

$serviceFactory = new \DeutschePost\Sdk\OneClickForApp\Service\ServiceFactory();
$service = $serviceFactory->createAccountInformationService($credentials, $logger);

// work with the web service response, e.g. replace PPL prices 
foreach ($service->getContractProducts() as $contractProduct) {
    $prodWsProduct = $this->productRepository->get($pplId = $contractProduct->getId());
    $prodWsProduct->setPrice($contractProduct->getPrice());
    $this->productRepository->save($prodWsProduct);
}
```

### Create Postal Stamp

Order _Internetmarke_ vouchers for a page format. If multiple vouchers
are requested with one service call, then the web service will create
all vouchers in one PDF file. The library attempts to split the original
document and return one label per voucher. This only works for certain
page formats and, for technical reasons, results in a larger total file size.

#### Public API

The library's components suitable for consumption comprise

* services:
  * application token storage
  * service factory
  * order service
  * data transfer object builder
* data transfer objects:
  * credentials
  * order with vouchers

#### Usage

```php
$logger = new \Psr\Log\Test\TestLogger();
$tokenStorage = new \DeutschePost\Sdk\OneClickForApp\Auth\TokenStorage();
$credentials = new \DeutschePost\Sdk\OneClickForApp\Auth\Credentials(
    $username = 'max.mustermann@example.com',
    $password = 'portokasse321',
    $partnerId = 'PARTNER_ID',
    $partnerKey = 'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
    $keyPhase = 1,
    $tokenStorage
);

// init a new builder for every order
$orderItemBuilder = \DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPositionBuilder::forPageFormat($pageFormatsWithAddress[0]);

// create as many items as needed per order
$orderItemBuilder->setItemDetails($prodWsProduct->getPPLId(), $prodWsProduct->getPrice());
$orderItemBuilder->setShipperAddress(
    $shipperCompany = 'DHL',
    $shipperCountry = 'DEU',
    $shipperPostalCode = '53113',
    $shipperCity = 'Bonn',
    $shipperStreetName = 'Charles-de-Gaulle-Straße',
    $shipperStreetNumber = '20',
    $shipperLastName = 'Doe',
    $shipperFirstName = 'John'
);

$orderItemBuilder->setRecipientAddress(
    $recipientLastName = 'Doe',
    $recipientFirstName = 'Jane',
    $recipientCountry = 'DEU',
    $recipientPostalCode = '53113',
    $recipientCity = 'Bonn',
    $recipientStreet = 'Sträßchensweg',
    $recipientStreetNumber = '2',
    null,
    null,
    $recipientCompany = 'DP'
);

$serviceFactory = new \DeutschePost\Sdk\OneClickForApp\Service\ServiceFactory();
$orderService = $serviceFactory->createOrderService($credentials, $logger);
$order = $orderService->createOrder(
    [$orderItemBuilder->create()],
    $orderItemBuilder->getTotalAmount(),
    $orderItemBuilder->getPageFormatId()
);

// work with the web service response, e.g. persist label
file_put_contents("/tmp/{$order->getId()}.pdf", $order->getLabel());
foreach ($order->getVouchers() as $voucher) {
    if ($voucher->getLabel()) {
        file_put_contents("/tmp/{$voucher->getVoucherId()}.pdf", $voucher->getLabel());
    }
}
```

### Persist Authentication Token

To reuse a token during its lifetime, the credentials object can be created with
a custom token storage. Implement access to a database, cache, or any other
suitable source.

#### Usage

```php
// PersistentTokenStorage implements \DeutschePost\Sdk\OneClickForApp\Api\TokenStorageInterface
$tokenStorage = new \My\OneClickForApp\Auth\PersistentTokenStorage();
$credentials = new \DeutschePost\Sdk\OneClickForApp\Auth\Credentials(
    $username = 'max.mustermann@example.com',
    $password = 'portokasse321',
    $partnerId = 'PARTNER_ID',
    $partnerKey = 'SCHLUESSEL_DPWN_MEINMARKTPLATZ',
    $keyPhase = 1,
    $tokenStorage
);
```
