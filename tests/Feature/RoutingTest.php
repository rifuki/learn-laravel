<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Programmer Zaman Now');
    }
    
    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/idonknow')
            ->assertSeeText('404 not found (fallback page)');
        $this->get('/notfound')
            ->assertSeeText('404 not found (fallback page)');
        $this->get('/routeany')
            ->assertSeeText('404 not found (fallback page)');
    }

    public function testRouteParameter(): void
    {
        $this->get('/products/1')
            ->assertSeeText('product 1');

        $this->get('/products/2')
            ->assertSeeText('product 2');
        
        $this->get('/products/35/items/xxx')
            ->assertSeeText('product: 35, item: xxx');

        $this->get('/products/11/items/xxx')
            ->assertSeeText('product: 11, item: xxx');
    }

    public function testRouteParameterRegex(): void
    {
        $this->get('/categories/11')
            ->assertSeeText('category_id: 11');
        
        $this->get('/categories/aaa')
            ->assertSeeText('404 not found');
    }

    public function testRouteParameterOptional(): void
    {
        $this->get('/users')
            ->assertSeeText('user_id: 404');
    }

    public function testRouteConflic(): void
    {
        $this->get('/conflict/budi')
            ->assertSeeText('user budi');
        
        $this->get('/conflict/eko')
            ->assertDontSeeText('conflict eko');
    }

    public function testNamedRoute(): void
    {
        $this->get('/produk/100')
            ->assertSeeText('link: http://localhost/products/100');

        $this->get('/produk-redirect/100')
            ->assertRedirect('/products/100');
    }

    public function testRequest(): void
    {
        $this->get('/controller/hello/request', [
            'Accept' => 'plain/text'
        ])
            ->assertSeeText('controller/hello/request')
            ->assertSeeText('http://localhost/controller/hello/request')
            ->assertSeeText('GET')
            ->assertSeetext('plain/text');
    }
}
