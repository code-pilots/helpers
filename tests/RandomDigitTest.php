<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function CodePilots\Helpers\randomDigital;

/**
 * @internal
 *
 * @coversNothing
 */
final class RandomDigitTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testRandomDigit(): void
    {
        $foundZero = false;

        for ($i = 0; $i < 100; ++$i) {
            self::assertIsNumeric($result = randomDigital(5, false));

            if ('0' === $result[0]) {
                $foundZero = true;
            }
        }

        self::assertTrue($foundZero);
    }

    /**
     * @throws Exception
     */
    public function testRandomNaturalDigit(): void
    {
        for ($i = 0; $i < 100; ++$i) {
            self::assertIsNumeric($result = randomDigital(5));

            self::assertFalse('0' === $result[0]);
        }
    }
}
