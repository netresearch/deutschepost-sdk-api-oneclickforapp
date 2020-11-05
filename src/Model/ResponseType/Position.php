<?php

/**
 * See LICENSE.md for license details.
 */

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class Position
{
    /**
     * @var int $labelX
     */
    private $labelX;

    /**
     * @var int $labelY
     */
    private $labelY;

    public function getLabelX(): int
    {
      return $this->labelX;
    }

    public function getLabelY(): int
    {
      return $this->labelY;
    }
}
