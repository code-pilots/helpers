<?php

namespace CodePilots\Helpers;

/**
 *  ARRAY RANDOM
 */
if (!function_exists(__NAMESPACE__ . '\arrayRandValue')) {
    /**
     * @template TValue
     *
     * @param array<array-key, TValue> $array
     *
     * @return TValue
     */
    function arrayRandValue(array $array): mixed
    {
        if (empty($array)) {
            return null;
        }

        /** @psalm-suppress ImpureFunctionCall */
        return $array[array_rand($array)];
    }
}

if (!function_exists(__NAMESPACE__ . '\arrayRandValues')) {
    /**
     * @template TValue
     *
     * @param non-empty-array<array-key, TValue> $array
     *
     * @return non-empty-array<array-key, TValue>
     */
    function arrayRandValues(array $array, int $num = 1): array
    {
        $result = [];
        $keys = array_rand($array, $num);
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        foreach ($keys as $key) {
            $result[$key] = $array[$key];
        }

        return $result;
    }
}

/**
 *  STRINGS
 */
const ALPHANUMERIC_CHAR = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
const NATURAL_DIGITS_CHAR = '123456789';
const DIGITS_CHAR = '0123456789';

if (!function_exists(__NAMESPACE__ . '\randomString')) {
    /**
     * @param positive-int $length
     *
     * @return non-empty-string
     *
     * @throws \Exception
     */
    function randomString(int $length, string $characters = ALPHANUMERIC_CHAR): string
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        assert('' !== $randomString);

        return $randomString;
    }
}

if (!function_exists(__NAMESPACE__ . '\randomDigital')) {
    /**
     * @param positive-int $length
     *
     * @return non-empty-string
     *
     * @throws \Exception
     */
    function randomDigital(int $length, bool $natural = true): string
    {
        $randomString = randomString($length, DIGITS_CHAR);
        if ($natural && '0' === $randomString[0]) {
            $randomString[0] = randomString(1, NATURAL_DIGITS_CHAR);
        }

        return $randomString;
    }
}

/**
 * ITERABLE
 */
if (!function_exists(__NAMESPACE__ . '\iterableChunks')) {
    /**
     * Analogue https://www.php.net/manual/ru/function.array-chunk.php but for iterable
     *
     * @template TValue
     *
     * @param iterable<TValue> $iterable
     *
     * @return \Generator<list<TValue>>
     */
    function iterableChunks(iterable $iterable, int $length): \Generator
    {
        $chunk = [];
        $i = 0;
        foreach ($iterable as $item) {
            $chunk[] = $item;
            if (++$i >= $length) {
                yield $chunk;
                $chunk = [];
                $i = 0;
            }
        }
        if ([] !== $chunk) {
            // Remaining chunk with fewer items.
            yield $chunk;
        }
    }
}

/**
 * IS INITIALIZED
 */
if (!function_exists(__NAMESPACE__ . '\isInitialized')) {
    function isInitialized(object $object, string $property): bool
    {
        if (!property_exists($object, $property)) {
            throw new \InvalidArgumentException(sprintf('Property "%s::%s" not exists', $object::class, $property));
        }

        try {
            /** @noinspection PhpExpressionResultUnusedInspection */
            $object->{$property};
        } catch (\Error $e) {
            return !str_contains($e->getMessage(), 'must not be accessed before initialization');
        }

        return true;
    }
}

if (!function_exists(__NAMESPACE__ . '\declationsOfNumber')) {
    /**
     * TODO describe
     *
     * @param positive-int                       $number
     * @param non-empty-array<array-key, string> $titles
     */
    function declationsOfNumber(int $number, array $titles): string
    {
        $cases = [2, 0, 1, 1, 1, 2];

        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}
