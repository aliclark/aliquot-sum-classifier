<?php

namespace AliquotSumClassifier;

class AliquotSumClassifier
{
    const DEFICIENT = 'deficient';
    const PERFECT   = 'perfect';
    const ABUNDANT  = 'abundant';

    /**
     * Determines whether the input is a deficient number, perfect number, or
     * abundant number.
     *
     * Please see https://en.wikipedia.org/wiki/Aliquot_sum for further info.
     *
     * @param int $n A number to classify greater than zero.
     * @return string One of AliquotSumClassifier::{DEFICIENT,PERFECT,ABUNDANT}
     * @throws InvalidArgumentException if the argument is not a positive non-zero integer.
     */
    public static function getClassification(int $n): string
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
