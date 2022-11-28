<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\arrayRandValues;

/**
 * @internal
 *
 * @coversNothing
 */
final class ArrayRandValuesTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRand(
        array $array,
        array $expected
    ): void {
        $result = arrayRandValues($array, count($array));

        self::assertEquals($expected, $result);
    }

    private function dataProvider(): array
    {
        return [
            [[1], [1]],
            [[1, 2], [1, 2]],
        ];
    }
}
