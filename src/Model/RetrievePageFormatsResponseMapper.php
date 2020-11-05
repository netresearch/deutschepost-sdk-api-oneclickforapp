<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;
use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\Orientation;
use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\PageFormat as ApiFormat;
use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\PageType;
use DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService\PageFormat;

class RetrievePageFormatsResponseMapper
{
    private function mapOrientation(string $apiOrientation): string
    {
        switch ($apiOrientation) {
            case Orientation::LANDSCAPE:
                return PageFormatInterface::ORIENTATION_LANDSCAPE;
            case Orientation::PORTRAIT:
                return PageFormatInterface::ORIENTATION_PORTRAIT;
            default:
                return '';
        }
    }

    private function mapType(string $apiPageType): string
    {
        switch ($apiPageType) {
            case PageType::REGULARPAGE:
                return PageFormatInterface::PAGE_MEDIUM_REGULAR_PAGE;
            case PageType::LABELPAGE:
                return PageFormatInterface::PAGE_MEDIUM_LABEL_PAGE;
            case PageType::ENVELOPE:
                return PageFormatInterface::PAGE_MEDIUM_ENVELOPE;
            case PageType::LABELPRINTER:
                return PageFormatInterface::PAGE_MEDIUM_LABELPRINTER;
            default:
                return '';
        }
    }

    /**
     * @param ApiFormat[] $apiFormats
     * @return PageFormatInterface[]
     */
    public function map(array $apiFormats): array
    {
        $pageFormats = [];
        foreach ($apiFormats as $apiFormat) {
            $orientation = $this->mapOrientation($apiFormat->getPageLayout()->getOrientation());
            $medium = $this->mapType($apiFormat->getPageType());

            $pageFormats[] = new PageFormat(
                $apiFormat->getId(),
                $apiFormat->getName(),
                (string) $apiFormat->getDescription(),
                $orientation,
                $medium,
                $apiFormat->getPageLayout()->getSize()->getX(),
                $apiFormat->getPageLayout()->getSize()->getY(),
                $apiFormat->getPageLayout()->getLabelCount()->getLabelX(),
                $apiFormat->getPageLayout()->getLabelCount()->getLabelY(),
                $apiFormat->isAddressPossible(),
                $apiFormat->isImagePossible()
            );
        }

        return $pageFormats;
    }
}
