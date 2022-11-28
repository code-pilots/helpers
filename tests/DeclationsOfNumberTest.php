<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\declationsOfNumber;

/**
 * @internal
 *
 * @coversNothing
 */
final class DeclationsOfNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @throws Exception
     */
    public function testDeclationsOfYears(
        int $years,
        array $titles,
        string $expected,
    ): void {
        $result = declationsOfNumber($years, $titles);

        self::assertEquals($expected, $result);
    }

    private function dataProvider(): array
    {
        return [
            [1, ['г', 'г', 'л'], 'г'],
            [2, ['г', 'г', 'л'], 'г'],
            [5, ['г', 'г', 'л'], 'л'],
            [6, ['г', 'г', 'л'], 'л'],
            [12, ['г', 'г', 'л'], 'л'],
            [16, ['г', 'г', 'л'], 'л'],
            [21, ['г', 'г', 'л'], 'г'],
        ];
    }
}
