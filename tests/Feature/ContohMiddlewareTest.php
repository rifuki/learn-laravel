<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testMiddlewareInvalid(): void
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('access denied');
    }

    public function testMiddlewareValid(): void
    {
        $this->withHeader('X-API-KEY', 'himitsu')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }

    public function testMiddlewareGroup(): void
    {
        $this->withHeader('X-API-KEY', 'himitsu')
            ->get('/middleware/groups')
            ->assertStatus(200)
            ->assertSeeText('GROUPS');
    }
}
