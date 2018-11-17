<?php

namespace AliquotSumClassifier;

class AliquotSumClassifierJsonController
{
    public function show(Integer $n)
    {
        return new AliquotSumClassifierJsonResource($n);
    }
}
