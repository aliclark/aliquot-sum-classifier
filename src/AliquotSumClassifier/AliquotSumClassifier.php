<?php

namespace AliquotSumClassifier;

interface AliquotSumClassifier
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
    public function getClassification(int $n): string;
}
