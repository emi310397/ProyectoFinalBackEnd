<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

abstract class FeatureTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('doctrine:clear:query:cache');
        Artisan::call('doctrine:clear:metadata:cache');
        Artisan::call('doctrine:clear:result:cache');

        Artisan::call('doctrine:schema:drop --force');
        Artisan::call('doctrine:schema:create');
    }
}
