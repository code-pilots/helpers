<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\iterableChunks;

/**
 * @internal
 *
 * @coversNothing
 */
final class IterableChunksTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @throws Exception
     */
    public function testIterableChunks(
        array $array,
        int $size,
        array $expected,
    ): void {
        $result = iterableChunks($array, $size);

        $i = 0;
        foreach ($result as $chunk) {
            self::assertEquals($expected[$i], $chunk);
            ++$i;
        }
    }

    private function dataProvider(): array
    {
        return [
            [[1], 1, [[1]]],
            [[1, 2, 3, 4, 5, 6, 7, 8], 2, [[1, 2], [3, 4], [5, 6], [7, 8]]],
            [[1, 2, 3, 4, 5, 6, 7, 8], 3, [[1, 2, 3], [4, 5, 6], [7, 8]]],
            [[1, 2, 3, 4, 5, 6, 7, 8], 4, [[1, 2, 3, 4], [5, 6, 7, 8]]],
            [[1, 2, 3, 4, 5, 6, 7, 8], 8, [[1, 2, 3, 4, 5, 6, 7, 8]]],
            [[1, 2, 3, 4, 5, 6, 7, 8], 9, [[1, 2, 3, 4, 5, 6, 7, 8]]],
        ];
    }
}
