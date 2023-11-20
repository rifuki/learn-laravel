<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie(): void 
    {
        $this->get('/cookie/set')
            ->assertSeeText('hello cookie')
            ->assertCookie('User-Id', 'rifuki')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie(): void
    {
        $this->withCookie('User-Id', 'rifuki')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'rifuki',
                'isMember' => 'true'
            ]);
    }
}
