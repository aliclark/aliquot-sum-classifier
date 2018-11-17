<?php

namespace AliquotSumClassifier;

use Illuminate\Http\Resources\Json\Resource;

// FIXME: Ensure that type is int at the controller, giving JSON error response
// otherwise.
// FIXME: Ensure that InvalidArgumentException leads to user-friendly error
// message.
class AliquotSumClassifierJsonResource extends Resource
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

    public function toArray($request)
    {
        return [
            'classification' => self::CLASSIFIER_STRINGS[$this->classifier->getClassification($request)]
        ];
    }
}
