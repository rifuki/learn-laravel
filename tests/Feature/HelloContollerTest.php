<?php

namespace Tests\Feature;

use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloContollerTest extends TestCase
{
    private HelloService $helloService;

    public function testHello(): void
    {
        $this->get('/controller/hello/rifuki')
            ->assertSeeText('Hello rifuki');
    }


}
