<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class PageLayout
{
    /**
     * @var Dimension $size
     */
    private $size;

    /**
     * @var string $orientation
     */
    private $orientation;

    /**
     * @var Dimension $labelSpacing
     */
    private $labelSpacing;

    /**
     * @var Position $labelCount
     */
    private $labelCount;

    /**
     * @var BorderDimension $margin
     */
    private $margin;

    public function getSize(): Dimension
    {
        return $this->size;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getLabelSpacing(): Dimension
    {
        return $this->labelSpacing;
    }

    public function getLabelCount(): Position
    {
        return $this->labelCount;
    }

    public function getMargin(): BorderDimension
    {
        return $this->margin;
    }
}
