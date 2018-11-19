<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\AliquotSumClassifier;

// TODO: Ensure that InvalidArgumentException leads to user-friendly JSON error
// message and 400 status.
class AliquotSumClassificationController extends Controller
{
    // Ensures the external contract with API consumers is upheld independently
    // of internal code changes
    private const CLASSIFIER_STRINGS = [
        AliquotSumClassifier::DEFICIENT => 'deficient',
        AliquotSumClassifier::PERFECT => 'perfect',
        AliquotSumClassifier::ABUNDANT => 'abundant'
    ];

    private $classifier;

    public function __construct(AliquotSumClassifier $classifier)
    {
        $this->classifier = $classifier;
    }

    public function show(Request $request, $param_n)
    {
        if (!ctype_digit($param_n)) {
           throw new \InvalidArgumentException('Input must be numeric');
        }
        $n = (int)$param_n;

        if (strval($n) !== $param_n) {
            // This could happen if $param_n is greater than PHP_INT_MAX for example
            throw new \InvalidArgumentException('Input could not be converted to a number.');
        }

        // FIXME: either add security or put a reasonably small limit on the
        // input value that can be queried and status 403 for queries that
        // exceed the limit.

        return response()->json([
            'data' => ['classification' => self::CLASSIFIER_STRINGS[$this->classifier->getClassification($n)]]
        ]);
    }
}
