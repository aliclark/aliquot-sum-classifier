<?php

namespace AliquotSumClassifier;

// Purposefully smelly name to encourage use of the interface and dependency
// injection instead of using this class directly
class AliquotSumClassifierImpl implements AliquotSumClassifier
{
    public function getClassification(int $n): string
    {
        if ($n <= 0) {
            throw InvalidArgumentException('Input must be a positive integer.');
        }

        $n_aliquot_sum = self::aliquotSum($n);

        if ($n_aliquot_sum < $n) {
            return self::DEFICIENT;
        }
        if ($n_aliquot_sum > $n) {
            return self::ABUNDANT;
        }
        return self::PERFECT;
    }

    private static function aliquotSum($n)
    {
        if ($n === 1) {
            return 0;
        }

        $sqrt_int = (int)sqrt($n);

        // starting from factor 2 means we're taking factor 1 as a given and
        // avoids adding the factor $n to the sum
        $n_aliquot_sum = 1;
        for ($x = 2; $x < $sqrt_int; $x++) {
            if (($n % $x) === 0) {
                $z = $n / $x; 
                $n_aliquot_sum += $x + $z;
            }
        }

        // if $n is a square number, add the square root factor once only
        if (($sqrt_int * $sqrt_int) === $n) {
                $n_aliquot_sum += $sqrt_int;
        }

        return $n_aliquot_sum;
    }
}
