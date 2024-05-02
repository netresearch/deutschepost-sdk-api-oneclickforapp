<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\VoucherList;
use DeutschePost\Sdk\OneClickForApp\Service\OrderService\Order;
use DeutschePost\Sdk\OneClickForApp\Service\OrderService\Voucher;

class ShoppingCartPDFResponseMapper
{
    /**
     * Retrieve one label per voucher if possible.
     *
     * This requires the Zend_Pdf library to be installed and works only if
     * the number of vouchers equals the number of pages in the PDF label
     * created with the web service call.
     *
     * @return string[]|null[]
     */
    private function getVoucherLabels(string $labelContent, VoucherList $voucherList): array
    {
        $voucherCount = count($voucherList->getVouchers());
        if ($voucherCount === 1) {
            return [$labelContent];
        }

        $orderPdf = class_exists('Zend_Pdf') ? \Zend_Pdf::parse($labelContent) : null;
        if (!$orderPdf || $voucherCount !== count($orderPdf->pages)) {
            // PDF library not available or page count mismatch. Unable to extract voucher label.
            return array_fill(0, $voucherCount, null);
        }

        return array_map(
            function (int $pageNumber) use ($orderPdf) {
                $voucherPdf = new \Zend_Pdf();
                $voucherPdf->pages[] = clone $orderPdf->pages[$pageNumber];

                try {
                    return $voucherPdf->render();
                } catch (\Zend_Pdf_Exception) {
                    return null;
                }
            },
            array_keys($voucherList->getVouchers())
        );
    }

    /**
     * Convert SOAP response to library response.
     *
     * The mapper attempts to split the PDF document into one document per order position.
     * This does only work for page formats which contain one voucher per page. If multiple items
     * are printed on one page (e.g. 2 columns, 3 rows; 10 items ordered → 2 pages created),
     * then the original PDF document contained with the order response must be used.
     */
    public function map(ShoppingCartPDFResponse $apiResponse): OrderInterface
    {
        $labelContent = file_get_contents($apiResponse->getLink());
        $voucherLabels = $this->getVoucherLabels($labelContent, $apiResponse->getShoppingCart()->getVoucherList());

        $items = [];
        foreach ($apiResponse->getShoppingCart()->getVoucherList()->getVouchers() as $index => $voucher) {
            $items[] = new Voucher(
                $voucher->getVoucherId(),
                $voucher->getTrackId(),
                $voucherLabels[$index]
            );
        }

        $manifest = '';
        if ($apiResponse->getManifestLink()) {
            $manifest = file_get_contents($apiResponse->getManifestLink());
        }

        return new Order(
            $apiResponse->getShoppingCart()->getShopOrderId() ?? '',
            $apiResponse->getWalletBalance(),
            $labelContent,
            $items,
            $manifest ?: null
        );
    }
}
