<?php

namespace Tests\Feature;

use Tests\TestCase;

class AliquotSumClassificationTest extends TestCase
{
    private const ENDPOINT = '/api/aliquot-sum-classifications';

    public function testJsonApi()
    {
        $response = $this->get(self::ENDPOINT);
        $response->assertStatus(404);

        $this->expectArgStatus('', 404);
        $this->expectArgStatus('null', 404);
        $this->expectArgStatus('0', 404);
        $this->expectArgStatus('2,2', 404);
        $this->expectArgStatus('-1', 404);

        $this->expectArgStatus('1', 200);
        $this->expectArgStatus('2', 200);
        $this->expectArgStatus('6', 200);
        $this->expectArgStatus('8', 200);
        $this->expectArgStatus('12', 200);
    }

    private function expectArgStatus($argstr, $status)
    {
        $response = $this->get(self::ENDPOINT.($argstr !== '' ? '/' : '').$argstr);
        $response->assertStatus($status);
    }
}
