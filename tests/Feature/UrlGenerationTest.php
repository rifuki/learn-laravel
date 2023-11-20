<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    public function testUrl(): void
    {
      $this->get("/url/current?name=rifuki")  
        ->assertSeeText("/url/current?name=rifuki");
    }

    public function testNamed(): void
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/hello/rifuki');
    }

    public function testAction(): void
    {
        $this->get('/url/action')
            ->assertSeeText('/form/csrf');
    }
}
