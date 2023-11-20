<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetEnv(): void
    {
        $youtube = env('YOUTUBE');
        self::assertEquals('Programmer Zaman Now', $youtube);
    }

    public function testDefaultEnv(): void
    {
        /* function env */
        // $author = env('AUTHOR', 'eko');

        /* class env */
        $author = Env::get('AUTHOR', 'eko');
        self::assertEquals('eko', $author);
    }
}
