<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\Data\OrderInterface;
use DeutschePost\Sdk\OneClickForApp\Service\OrderService\Order;
use DeutschePost\Sdk\OneClickForApp\Service\OrderService\Voucher;

class ShoppingCartPDFResponseMapper
{
    private function extractPage(\Zend_Pdf $pdf, int $pageNumber): ?string
    {
        $frankingPdf = new \Zend_Pdf();
        $frankingPdf->pages[] = clone $pdf->pages[$pageNumber];

        try {
            return $frankingPdf->render();
        } catch (\Zend_Pdf_Exception $exception) {
            return null;
        }
    }

    /**
     * Convert SOAP response to library response.
     *
     * The mapper attempts to split the PDF document into one document per order position.
     * This does only work for page formats which contain one voucher per page. If multiple items
     * are printed on one page (e.g. 2 columns, 3 rows; 10 items ordered → 2 pages created),
     * then the original PDF document contained with the order response must be used.
     *
     * @param ShoppingCartPDFResponse $apiResponse
     * @return OrderInterface
     */
    public function map(ShoppingCartPDFResponse $apiResponse): OrderInterface
    {
        $labelContent = file_get_contents($apiResponse->getLink());
        $labelPdf = \Zend_Pdf::parse($labelContent);

        $voucherCount = count($apiResponse->getShoppingCart()->getVoucherList()->getVouchers());
        $pageCount = count($labelPdf->pages);

        $items = [];
        foreach ($apiResponse->getShoppingCart()->getVoucherList()->getVouchers() as $index => $voucher) {
            $items[] = new Voucher(
                $voucher->getVoucherId(),
                $voucher->getTrackId(),
                ($pageCount === $voucherCount) ? $this->extractPage($labelPdf, $index) : null
            );
        }

        return new Order(
            $apiResponse->getShoppingCart()->getShopOrderId() ?? '',
            $apiResponse->getWalletBalance(),
            $labelContent,
            $items,
            $apiResponse->getManifestLink() ? file_get_contents($apiResponse->getManifestLink()) : null
        );
    }
}
