<?php

/**
 * See LICENSE.md for license details.
 */

namespace DeutschePost\Sdk\OneClickForApp\Test\TestDouble;

class SoapClientFake extends \SoapClient
{
    /**
     * SoapClientFake constructor.
     *
     * PHPUnit does not pass through the wsdl to the client constructor, need to add it by overriding original one.
     *
     * @param mixed[]|null $options
     * @throws \SoapFault
     */
    public function __construct(mixed $wsdl, array $options = null)
    {
        $wsdl = __DIR__ . '/../Provider/_files/OneClickForApp/OneClickForAppV3.wsdl';

        parent::__construct($wsdl, $options);
    }
}
