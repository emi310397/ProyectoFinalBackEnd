<?php

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Seeder;
use Tests\Utils\Traits\Database\DatabasePreparerTrait;
use Tests\Utils\Traits\Fixtures\FixtureLoaderTrait;

class DatabaseSeeder extends Seeder
{
    use DatabasePreparerTrait;
    use FixtureLoaderTrait;

    /** @var Application */
    protected $app;

    public function run(): void
    {
        $this->app = app();
        $this->prepareDatabase();
        $this->loadFixturesFromProvider();
    }
}
