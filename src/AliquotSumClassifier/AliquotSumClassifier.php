<?php

namespace AliquotSumClassifier;

interface AliquotSumClassifier
{
    // Constants for IDE search goodness
    const DEFICIENT = 'deficient';
    const PERFECT   = 'perfect';
    const ABUNDANT  = 'abundant';

    /**
     * Determines whether the input is a deficient number, perfect number, or
     * abundant number.
     *
     * Please see https://en.wikipedia.org/wiki/Aliquot_sum for further info.
     *
     * XXX: The standard implementation for calculation is O(sqrt(N)) in time,
     * so for larger inputs this may be CPU blocking.
     *
     * @param int $n A number to classify greater than zero.
     * @return string One of AliquotSumClassifier::{DEFICIENT,PERFECT,ABUNDANT}
     * @throws InvalidArgumentException if the argument is not a positive non-zero integer.
     */
    public function getClassification(int $n): string;
}
