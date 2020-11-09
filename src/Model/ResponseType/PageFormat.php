<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\ResponseType;

class PageFormat
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var bool $isAddressPossible
     */
    private $isAddressPossible;

    /**
     * @var bool $isImagePossible
     */
    private $isImagePossible;

    /**
     * @var string $pageType
     */
    private $pageType;

    /**
     * @var PageLayout $pageLayout
     */
    private $pageLayout;

    /**
     * @var string|null $description
     */
    private $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isAddressPossible(): bool
    {
        return $this->isAddressPossible;
    }

    public function isImagePossible(): bool
    {
        return $this->isImagePossible;
    }

    public function getPageType(): string
    {
        return $this->pageType;
    }

    public function getPageLayout(): PageLayout
    {
        return $this->pageLayout;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
