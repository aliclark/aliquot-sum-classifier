<?php

namespace Tests\AliquotSumClassifier;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AliquotSumClassifierImplTest extends AliquotSumClassifierTest
{
    private const LOCAL_DURATION_MAX_SECS = 0.5;

    public function __construct()
    {
        AliquotSumClassifierTest::__construct(new AliquotSumClassifierImpl());
    }

    // FIXME: this test is more of a prompt to consider what the maximum
    // allowed input should be based on consumer needs and denial of service
    // security requirements
    public function testPerformance()
    {
        $time_start = microtime_float();

        $this->classifier->getClassification(PHP_INT_MAX);

        $time_end = microtime_float();
        $duration = $time_end - $time_start;

        ExpectedLessThan($duration, self::LOCAL_DURATION_MAX_SECS);
    }
}
