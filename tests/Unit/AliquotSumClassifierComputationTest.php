<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\AliquotSumClassifierComputation;

class AliquotSumClassifierComputationTest extends AliquotSumClassifierBaseTestCase
{
    private const LOCAL_DURATION_MAX_SECS = 0.5;

    public function setUp()
    {
        parent::setClassifier(new AliquotSumClassifierComputation());
    }

    // FIXME: this test is more of a prompt to consider what the maximum
    // allowed input should be based on consumer needs and denial of service
    // security requirements
    public function testPerformance()
    {
        $time_start = microtime(true);

        // XXX: about pow(2, 46) is where this becomes slow
        //$this->classifier->getClassification(pow(2, 46));
        $this->classifier->getClassification(PHP_INT_MAX);

        $time_end = microtime(true);
        $duration = $time_end - $time_start;

        $this->assertLessThan($duration, self::LOCAL_DURATION_MAX_SECS);
    }
}
