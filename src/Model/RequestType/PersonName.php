<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Model\RequestType;

class PersonName
{
    /**
     * @var string $firstname
     */
    private $firstname;

    /**
     * @var string $lastname
     */
    private $lastname;

    /**
     * @var string|null $salutation
     */
    private $salutation;

    /**
     * @var string|null $title
     */
    private $title;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
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
