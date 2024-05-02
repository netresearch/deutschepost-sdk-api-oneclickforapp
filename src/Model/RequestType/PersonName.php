<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class PersonName
{
    private ?string $salutation = null;

    private ?string $title = null;

    public function __construct(private string $firstname, private string $lastname)
    {
    }

    public function setSalutation(string $salutation): void
    {
        $this->salutation = $salutation;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
