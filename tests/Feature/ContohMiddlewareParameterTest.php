<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareParameterTest extends TestCase
{
    public function testMiddlewareParameterValid(): void
    {
        $this->withHeader('X-API-KEY', 'himitsu')
            ->get('/middleware/parameters')
            ->assertStatus(200)
            ->assertSeeText('OK PARAMETER');
    }

    public function testMiddlewareParameterInvalid(): void
    {
        $this->get('/middleware/parameters')
            ->assertStatus(401)
            ->assertSeeText('Access Denied');
    }
}
