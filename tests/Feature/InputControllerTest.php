<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        /* * Get request query parameter */
        $this->get('/input/hello?name=rifuki')
            ->assertSeeText('Hello rifuki');
            
        /* * Post request body */
        $this->post('/input/hello', [
            'name' => 'aozora'
        ])
            ->assertSeeText('Hello aozora');

    }

    public function testInputNested(): void
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Rifuki',
                'last' => 'Mahoma'
            ]
        ])
            ->assertSeeText('Hello Rifuki');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Mahoma',
                'last' => 'Rifuki'
            ],
            'address' => [
                [
                    'city' => 'Solo',
                    'country' => 'Indonesia' 
                ],
                [
                    'city' => 'Bogor',
                    'country' => 'Indonesia'
                ]
            ],
            'hobbies' => [
                'Coding',
                'Reading'
            ],
            'debug' => true
        ])
            ->assertSeeText('name')
            ->assertSeeText('first')->assertSee('Mahoma')
            ->assertSeeText('last')->assertSee('Rifuki')
            ->assertSeeText('address')
            ->assertSeeText('city')->assertSeeText('Solo')
            ->assertSeeText('country')->assertSeeText('Indonesia')
            ->assertSeeText('city')->assertSeeText('Bogo')
            ->assertSeeText('country')->assertSeeText('Indonesia')
            ->assertSeeText('hobbies') ->assertSeeText('Coding') ->assertSeeText('Reading')
            ->assertSeeText('debug')->assertSeeText('true');
    }

    public function testArray(): void
    {
        $this->post('/input/hello/input', [
            'products' => [
                [
                    'name' => 'Apple Macbook M1 Air'
                ],
                [
                    'name' => 'Apple Macbook M1 Pro'
                ],
                [
                    'name' => 'Apple Macbook M2 Air'
                ],
                [
                    'name' => 'Apple Macbook M2 Pro'
                ]
            ]
        ])
            ->assertSeeText('Apple Macbook M1 Air')
            ->assertSeeText('Apple Macbook M1 Pro')
            ->assertSeeText('Apple Macbook M2 Air')
            ->assertSeeText('Apple Macbook M1 Pro');
    }

    public function testInputType(): void
    {
        $this->post('/input/type', [
            'name' => 'aozora',
            'married' => false,
            'birth_date' => '2001-01-1'
        ])
            ->assertSeeText('name')->assertSeeText('aozora')
            ->assertSeeText('married')->assertSeeText('false')
            ->assertSeeText('birth_date')->assertSeeText('01-01-01');
    }

    public function testFilterOnly(): void
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'mahoma',
                'middle' => 'riku',
                'last' => 'rifuki',
            ]
        ])
            ->assertSeeText('name')
            ->assertSeeText('first')->assertSeeText('mahoma')
            ->assertDontSeeText('middle')->assertDontSeeText('riku')
            ->assertSeeText('last')->assertSeeText('rifuki');
    }

    public function testFilterExcept(): void
    {
        $this->post('/input/filter/except', [
            'username' => 'rifuki',
            'admin' => 'true',
            'password' => 'himitsu'
        ])
            ->assertSeeText('username')->assertSeeText('rifuki')
            ->assertDontSeeText('admin')->assertDontSeeText('true')
            ->assertSeeText('password')->assertSeeText('himitsu');
    }

    public function testFilterMerge(): void
    {
        $this->post('/input/filter/except', [
            'username' => 'rifuki',
            'admin' => 'true',
            'password' => 'himitsu'
        ])
            ->assertSeeText('username')->assertSeeText('rifuki')
            ->assertDontSeeText('admin')->assertDontSeeText('true')
            ->assertSeeText('password')->assertSeeText('himitsu');
    }
}
