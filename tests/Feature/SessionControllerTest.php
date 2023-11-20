<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession(): void
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'rifuki')
            ->assertSessionHas('isMember', true);
    }

    public function testGetSessionValid(): void
    {
        $this->withSession([
            'userId' => 'rifuki',
            'isMember' => var_export(true, true)
        ])->get('/session/get')
            ->assertSeeText('rifuki')->assertSeeText('true');
    }

    public function testGetSessionInvalid(): void
    {
        $this->withSession([
        ])->get('/session/get')
            ->assertSeeText('guest')->assertSeeText('false');
    }
}
