<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace DeutschePost\Sdk\OneClickForApp\Test\TestCase\Model;

use DeutschePost\Sdk\OneClickForApp\Model\VoucherPositionCalculator;
use PHPUnit\Framework\TestCase;

class VoucherPositionCalculatorTest extends TestCase
{
    public function dataProvider(): array
    {
        return [
            // one item per page
            '1_1_1' => [1, 1, 1, 1, 1, 1],
            '1_1_2' => [1, 1, 2, 2, 1, 1],
            '1_1_4' => [1, 1, 4, 4, 1, 1],
            '1_1_8' => [1, 1, 8, 8, 1, 1],
            '1_1_16' => [1, 1, 16, 16, 1, 1],
            // three items per page (1x3)
            '1_3_1' => [1, 3, 1, 1, 1, 1],
            '1_3_2' => [1, 3, 2, 1, 1, 2],
            '1_3_4' => [1, 3, 4, 2, 1, 1],
            '1_3_8' => [1, 3, 8, 3, 1, 2],
            '1_3_16' => [1, 3, 16, 6, 1, 1],
            // six items per page (2x3)
            '2_3_1' => [2, 3, 1, 1, 1, 1],
            '2_3_2' => [2, 3, 2, 1, 2, 1],
            '2_3_4' => [2, 3, 4, 1, 2, 2],
            '2_3_8' => [2, 3, 8, 2, 2, 1],
            '2_3_16' => [2, 3, 16, 3, 2, 2],
        ];
    }

    /**
     * @test
     * @dataProvider dataProvider
     *
     * @param int $pageColumns
     * @param int $pageRows
     * @param int $itemNumber
     * @param int $resultPage
     *
     * @param int $resultColumn
     * @param int $resultRow
     * @throws \ReflectionException
     */
    public function getVoucherPosition(
        int $pageColumns,
        int $pageRows,
        int $itemNumber,
        int $resultPage,
        int $resultColumn,
        int $resultRow
    ): void {
        $calculator = new VoucherPositionCalculator();
        $position = $calculator->getVoucherPosition($pageColumns, $pageRows, $itemNumber);

        $reflectionClass = new \ReflectionClass(get_class($position));

        $reflectionProperty = $reflectionClass->getProperty('page');
        $reflectionProperty->setAccessible(true);
        self::assertSame(
            $resultPage,
            $reflectionProperty->getValue($position),
            "Item $itemNumber must be displayed on page $resultPage ({$pageColumns}x{$pageRows})."
        );

        $reflectionProperty = $reflectionClass->getProperty('labelX');
        $reflectionProperty->setAccessible(true);
        self::assertSame(
            $resultColumn,
            $reflectionProperty->getValue($position),
            "Item $itemNumber must be displayed in col $resultColumn ({$pageColumns}x{$pageRows})."
        );

        $reflectionProperty = $reflectionClass->getProperty('labelY');
        $reflectionProperty->setAccessible(true);
        self::assertSame(
            $resultRow,
            $reflectionProperty->getValue($position),
            "Item $itemNumber must be displayed in row $resultRow ({$pageColumns}x{$pageRows})."
        );
    }
}
