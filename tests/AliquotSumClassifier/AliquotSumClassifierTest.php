<?php

namespace Tests\AliquotSumClassifier;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AliquotSumClassifierTest extends TestCase
{
    protected $classifier;

    public function __construct(AliquotSumClassifier $classifier)
    {
        $this->classifier = $classifier;
    }

    public function testInputValidation()
    {
        ExpectException($classifier->getClassification(null), TypeError::class);
        ExpectException($classifier->getClassification(true), TypeError::class);
        ExpectException($classifier->getClassification(3.0), TypeError::class);
        ExpectException($classifier->getClassification('3'), TypeError::class);

        ExpectException($classifier->getClassification(-3), InvalidArgumentException::class);
        ExpectException($classifier->getClassification(-1), InvalidArgumentException::class);
        ExpectException($classifier->getClassification(0), InvalidArgumentException::class);
    }

    public function testClassification()
    {
        // test some values manually for sanity
        ExpectValue($classifier->getClassification(1), AliquotSumClassifier::DEFICIENT);
        ExpectValue($classifier->getClassification(4), AliquotSumClassifier::DEFICIENT);
        ExpectValue($classifier->getClassification(6), AliquotSumClassifier::PERFECT);
        ExpectValue($classifier->getClassification(8), AliquotSumClassifier::DEFICIENT);
        ExpectValue($classifier->getClassification(12), AliquotSumClassifier::ABUNDANT);

        // test a larger range automatically for sanity
        // from https://en.wikipedia.org/wiki/Aliquot_sum#Examples
        $expected_sums = [0, 1, 1, 3, 1, 6, 1, 7, 4, 8, 1, 16, 1, 10, 9, 15, 1,
          21, 1, 22, 11, 14, 1, 36, 6, 16, 13, 28, 1, 42, 1, 31, 15, 20, 13,
          55, 1, 22, 17, 50, 1, 54, 1, 40, 33, 26, 1, 76, 8, 43];

        foreach ($expected_sums as $index => $expected_sum) {
            $n = $index + 1;
            $classification = $classifier->getClassification($n);

            if ($expected_sum < $n) {
                ExpectValue($classification, AliquotSumClassifier::DEFICIENT);
            }
            elseif ($expected_sum > $n) {
                ExpectValue($classification, AliquotSumClassifier::ABUNDANT);
            }
            else {
                ExpectValue($classification, AliquotSumClassifier::PERFECT);
            }
        }
    }
}
