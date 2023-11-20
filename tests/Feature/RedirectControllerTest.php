<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect(): void
    {
         $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectName(): void
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/hello/rifuki');
    }

    public function testRedirectAction(): void
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/hello/rifuki');
    }

    public function testRedirectAway(): void
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://www.apple.com');
    }
}
