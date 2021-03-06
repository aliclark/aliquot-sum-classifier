<?php

namespace App;

// Engineering an application using interfaces and dependency injection this
// way takes some upfront effort, but leads to very testable and cleanly
// abstracted reusable components.. it scales and ages surprisingly well.
//
// But if unsure about the engineering needed for new code, a good rule of
// thumb is to start writing code as either static class methods or private
// method to an existing class depending on which is applicable, then refactor
// the code out with interfaces and DI once it makes sense to do that.
//
// In real life for a simple example like this, static methods with no
// interface would be more expedient and appropriate until proven otherwise:
//
// class AliquotSumClassifier {
//     /** documentation */
//     public  static function getClassification(int $n): string { ... }
//     private static function aliquotSum($n) { ... }
// }

class AliquotSumClassifierComputation implements AliquotSumClassifier
{
    public function getClassification(int $n): string
    {
        if ($n <= 0) {
            throw new \InvalidArgumentException('Input must be a positive integer.');
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

        $sqrt_float = sqrt($n);

        // starting from factor 2 means we're taking factor 1 as a given and
        // avoids adding the factor $n to the sum
        $n_aliquot_sum = 1;
        for ($x = 2; $x < $sqrt_float; ++$x) {
            if (($n % $x) === 0) {
                $n_aliquot_sum += $x + ($n / $x);
            }
        }

        $sqrt_int = (int)$sqrt_float;

        // if $n is a square number, add the square root factor once only
        if (($sqrt_int * $sqrt_int) === $n) {
                $n_aliquot_sum += $sqrt_int;
        }

        return $n_aliquot_sum;
    }
}
