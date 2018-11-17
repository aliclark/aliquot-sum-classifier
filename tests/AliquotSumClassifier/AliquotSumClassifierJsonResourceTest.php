<?php

namespace Tests\AliquotSumClassifier;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AliquotSumClassifierJsonResourceTest extends TestCase
{
    private const ENDPOINT = '/aliquot-sum-classification';

    public function testJsonApi()
    {
        $response = $this->get(self::ENDPOINT);
        $response->assertStatus(400);

        $this->expectArgStatus('', 400);
        $this->expectArgStatus('null', 400);
        $this->expectArgStatus('0', 400);
        $this->expectArgStatus('2,2', 400);
        $this->expectArgStatus('-1', 400);

        $this->expectArgStatus('1', 200);
        $this->expectArgStatus('2', 200);
        $this->expectArgStatus('6', 200);
        $this->expectArgStatus('8', 200);
        $this->expectArgStatus('12', 200);
    }

    private function expectArgStatus($argstr, $status)
    {
        $response = $this->get(self::ENDPOINT.'?n='.$argstr);
        $response->assertStatus($status);

    }
}
