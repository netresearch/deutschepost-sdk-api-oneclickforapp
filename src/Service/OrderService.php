<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Api\OrderServiceInterface;
use DeutschePost\Sdk\OneClickForApp\Auth\TokenProvider;
use DeutschePost\Sdk\OneClickForApp\Exception\AuthenticationErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\DetailedErrorException;
use DeutschePost\Sdk\OneClickForApp\Exception\ServiceExceptionFactory;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShippingList;
use DeutschePost\Sdk\OneClickForApp\Model\RequestType\ShoppingCartPDFPosition;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFRequest;
use DeutschePost\Sdk\OneClickForApp\Model\ShoppingCartPDFResponseMapper;
use DeutschePost\Sdk\OneClickForApp\Soap\AbstractClient;

class OrderService implements OrderServiceInterface
{
    public function __construct(private AbstractClient $client, private TokenProvider $tokenProvider, private ShoppingCartPDFResponseMapper $responseMapper)
    {
    }

    public function createOrder(
        array $items,
        int $orderTotal,
        int $pageFormat,
        bool $createManifest = false,
        bool $createShippingList = false
    ): OrderInterface {
        /** @var ShoppingCartPDFPosition[] $items */
        $request = new ShoppingCartPDFRequest(
            $this->tokenProvider->getToken(),
            $pageFormat,
            $items,
            $orderTotal
        );
        $request->setCreateManifest($createManifest);
        $request->setCreateShippingList($createShippingList ? ShippingList::A2 : ShippingList::A0);

        try {
            $response = $this->client->checkoutShoppingCartPDF($request);
            return $this->responseMapper->map($response);
        } catch (AuthenticationErrorException) {
            $this->tokenProvider->resetToken();
            return $this->createOrder($items, $orderTotal, $pageFormat, $createManifest, $createShippingList);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }
}
