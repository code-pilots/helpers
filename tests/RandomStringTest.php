<?php

declare(strict_types=1);

use const CodePilots\Helpers\ALPHANUMERIC_CHAR;
use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\randomString;

/**
 * @internal
 *
 * @coversNothing
 */
final class RandomStringTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @throws Exception
     */
    public function testRandomString(
        int $length,
        string $characters
    ): void {
        $result = randomString($length, $characters);

        self::assertEquals($length, strlen($result));
        $splitCharacters = str_split($characters);

        foreach (array_filter(str_split($result)) as $resultCharacter) {
            self::assertContains($resultCharacter, $splitCharacters);
        }
    }

    private function dataProvider(): array
    {
        return [
            [1, '1'],
            [5, '1'],
            [1, ALPHANUMERIC_CHAR],
            [5, ALPHANUMERIC_CHAR],
        ];
    }
}
