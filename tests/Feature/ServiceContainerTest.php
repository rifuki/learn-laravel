<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency(): void 
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('foo', $foo1->foo());
        self::assertEquals('foo', $foo2->foo());
        // self::assertNotSame($foo1, $foo2); /* <- it's works before add service provider */
        self::assertSame($foo1, $foo2); /* <- change these after adding service provider */
    }

    public function testBind(): void
    {
        $this->app->bind(Person::class, function($app) { /* <- will create different object */
            return new Person('Mahoma', 'Rifuki');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Mahoma', $person1->firstName);
        self::assertEquals('Rifuki', $person1->lastName);
        self::assertEquals('Mahoma', $person2->firstName);
        self::assertEquals('Rifuki', $person2->lastName);

        self::assertNotSame($person1, $person2);
    }


    public function testSingleton(): void
    {
        $this->app->singleton(Person::class, function($app) { /* <- will create same object if exist */
            return new Person('Mahoma', 'Rifuki');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Mahoma', $person1->firstName);
        self::assertEquals('Rifuki', $person1->lastName);
        self::assertEquals('Mahoma', $person2->firstName);
        self::assertEquals('Rifuki', $person2->lastName);

        self::assertSame($person1, $person2);
    }

    public function testInstance(): void
    {
        $person = new Person('Mahoma', 'Rifuki');

        $this->app->instance(Person::class, $person); /* <- same as singleton return same object */

        $person1 = $this->app->make(Person::class); /* <- return $person */
        $person2 = $this->app->make(Person::class); /* <- return $person */

        self::assertEquals('Mahoma', $person1->firstName);
        self::assertEquals('Rifuki', $person1->lastName);
        self::assertEquals('Mahoma', $person2->firstName);
        self::assertEquals('Rifuki', $person2->lastName);

        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection() 
    {
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class); /* make instantiable */

        $this->app->singleton(HelloService::class, function($app) { /* another way make instatiable (recommended for more complex closure) */
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Hello Rifuki", $helloService->hello('Rifuki'));
    }
}