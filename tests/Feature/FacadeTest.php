<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig() 
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);

        // var_dump(Config::all());
    }

    public function testConfigDependency() 
    {
        $config = $this->app->make('config');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first'); /* with facades */
        $firstName3 = $config->get('contoh.author.first'); /* manual without facades */

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName2, $firstName3);

        // var_dump($config->all());
    }

    public function testFacadesMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Rifuki keren');

        $firstname = Config::get('contoh.author.first');

        self::assertEquals('Rifuki keren', $firstname);
    }
}
