<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Api\Data;

/**
 * @api
 */
interface PageFormatInterface
{
    public const ORIENTATION_PORTRAIT = 'PORTRAIT';
    public const ORIENTATION_LANDSCAPE = 'LANDSCAPE';

    public const PAGE_MEDIUM_REGULAR_PAGE = 'REGULARPAGE';
    public const PAGE_MEDIUM_LABEL_PAGE = 'LABELPAGE';
    public const PAGE_MEDIUM_ENVELOPE = 'ENVELOPE';
    public const PAGE_MEDIUM_LABELPRINTER = 'LABELPRINTER';

    /**
     * Obtain the page format's id.
     */
    public function getId(): int;

    /**
     * Obtain the page format's name.
     */
    public function getName(): string;

    /**
     * Obtain the page format's name.
     */
    public function getDescription(): string;

    /**
     * Obtain the page orientation.
     *
     * @return string Enum: PORTRAIT or LANDSCAPE
     */
    public function getOrientation(): string;

    /**
     * Check which medium the page format applies is suitable for.
     *
     * @return string Enum: REGULARPAGE, LABELPAGE, LABELPRINTER or ENVELOPE
     */
    public function getPrintMedium(): string;

    /**
     * Obtain the horizontal size of the print format in millimeters.
     */
    public function getSizeX(): float;

    /**
     * Obtain the vertical size of the print format in millimeters.
     */
    public function getSizeY(): float;

    /**
     * Check how many items can be printed on the format in X-direction.
     */
    public function getColumns(): int;

    /**
     * Check how many items can be printed on the format in Y-direction.
     */
    public function getRows(): int;

    /**
     * Check if an address can be printed on the page format.
     */
    public function isAddressPossible(): bool;

    /**
     * Check if an image can be printed on the page format.
     */
    public function isImagePossible(): bool;
}
