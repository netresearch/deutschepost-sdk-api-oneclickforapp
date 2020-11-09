<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class BorderDimension
{
    /**
     * @var float $top
     */
    private $top;

    /**
     * @var float $bottom
     */
    private $bottom;

    /**
     * @var float $left
     */
    private $left;

    /**
     * @var float $right
     */
    private $right;

    public function getTop(): float
    {
        return $this->top;
    }

    public function getBottom(): float
    {
        return $this->bottom;
    }

    public function getLeft(): float
    {
        return $this->left;
    }

    public function getRight(): float
    {
        return $this->right;
    }
}
