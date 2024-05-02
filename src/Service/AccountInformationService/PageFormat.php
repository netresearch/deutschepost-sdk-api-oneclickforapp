<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;

class PageFormat implements PageFormatInterface
{
    public function __construct(private int $id, private string $name, private string $description, private string $orientation, private string $printMedium, private float $sizeX, private float $sizeY, private int $columns, private int $rows, private bool $addressPossible, private bool $imagePossible)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getPrintMedium(): string
    {
        return $this->printMedium;
    }

    public function getSizeX(): float
    {
        return $this->sizeX;
    }

    public function getSizeY(): float
    {
        return $this->sizeY;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function isAddressPossible(): bool
    {
        return $this->addressPossible;
    }

    public function isImagePossible(): bool
    {
        return $this->imagePossible;
    }
}
