<?php

namespace Tests\Unit;

use Faker\Factory as FakerFactory;
use Faker\Generator;
use Tests\TestCase;
use Tests\Utils\Traits\AutoInjectableMockTrait;
use Tests\Utils\Traits\PrivateGetSet;

abstract class UnitTestCase extends TestCase
{
    use PrivateGetSet;
    use AutoInjectableMockTrait;

    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = FakerFactory::create('es_AR');
    }

    public function getFaker() : Generator
    {
        return $this->faker;
    }
}
