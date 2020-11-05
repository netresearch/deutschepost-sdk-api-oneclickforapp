<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model;

use DeutschePost\Sdk\OneClickForApp\Model\ResponseType\PageFormat;

class RetrievePageFormatsResponse
{
    /**
     * @var PageFormat|PageFormat[] $pageFormat
     */
    private $pageFormat;

    /**
     * @return PageFormat[]
     */
    public function getPageFormats(): array
    {
        if (empty($this->pageFormat)) {
            return [];
        }

        if ($this->pageFormat instanceof PageFormat) {
            return [$this->pageFormat];
        }

        return $this->pageFormat;
    }
}
