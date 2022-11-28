<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\arrayRandValue;

/**
 * @internal
 *
 * @coversNothing
 */
final class ArrayRandValueTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRand(
        array $array,
        null|array|int $expected
    ): void {
        $result = arrayRandValue($array);

        if (is_array($expected)) {
            self::assertNotFalse(array_search($result, $expected, true));
        } else {
            self::assertEquals($expected, $result);
        }
    }

    private function dataProvider(): array
    {
        return [
            [[1], 1],
            [[], null],
            [[1, 2], [1, 2]],
        ];
    }
}
