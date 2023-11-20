<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse(): void  
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }

    public function testHeader(): void
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('firstName')->assertSeeText('mahoma')
            ->assertSeeText('lastName')->assertSeeText('rifuki')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('author', 'mahoma rifuki')
            ->assertHeader('app', 'learning laravel');
    }

    public function testView(): void
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello rifuki');
    }

    public function testJson(): void
    {
        $this->get('/response/type/json')
            ->assertHeader('Content-Type', 'application/json')
            ->assertJson([
                'firstName' => 'mahoma',
                'lastName' => 'rifuki'
            ]);
    }

    public function testFile(): void
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload(): void
    {
        $this->get('/response/type/download')
            ->assertHeader('Content-Type', 'image/jpeg')
            ->assertDownload('kuroi.jpg');
    }
}
