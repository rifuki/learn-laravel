<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Rifuki');

        $this->get('/hello-again')
            ->assertSeeText('Hello Aozora');

        $this->get('/hello-world')
            ->assertSeeText('World Rifuki');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Rifuki'])
            ->assertSeeText('Hello Rifuki');
    }
}
