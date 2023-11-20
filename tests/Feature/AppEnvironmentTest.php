<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAppEnv(): void {
        // var_dump(App::environment());
        // if(App::environment('testing')){
        //     self::assertTrue(true);
        // }
        if(App::environment(['testing', 'dev'])){
            self::assertTrue(true);
        }
    }
}
