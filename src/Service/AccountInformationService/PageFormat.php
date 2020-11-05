<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Service\AccountInformationService;

use DeutschePost\Sdk\OneClickForApp\Api\Data\PageFormatInterface;

class PageFormat implements PageFormatInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $orientation;

    /**
     * @var string
     */
    private $printMedium;

    /**
     * @var float
     */
    private $sizeX;

    /**
     * @var float
     */
    private $sizeY;

    /**
     * @var int
     */
    private $columns;

    /**
     * @var int
     */
    private $rows;

    /**
     * @var bool
     */
    private $addressPossible;

    /**
     * @var bool
     */
    private $imagePossible;

    public function __construct(
        int $id,
        string $name,
        string $description,
        string $orientation,
        string $printMedium,
        float $sizeX,
        float $sizeY,
        int $columns,
        int $rows,
        bool $addressPossible,
        bool $imagePossible
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->orientation = $orientation;
        $this->printMedium = $printMedium;
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
        $this->columns = $columns;
        $this->rows = $rows;
        $this->addressPossible = $addressPossible;
        $this->imagePossible = $imagePossible;
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
