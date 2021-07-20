<?php

namespace Tests\Utils\Traits\Fixtures;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\Loader as FixtureLoader;
use Illuminate\Contracts\Foundation\Application;
use Tests\Utils\Fixtures\FixturesProvider;

trait FixtureLoaderTrait
{
    /**
     * @var Application
     */
    protected $app;

    private ?ORMExecutor $fixtureExecutor = null;
    private ?FixtureLoader $fixtureLoader = null;

    /**
     * Load fixtures in test database
     *
     * Info: Addition order must be related to dependencies between fixtures.
     */
    protected function loadFixturesFromProvider(): void
    {
        array_map([$this, 'addFixture'], FixturesProvider::get());

        $this->executeFixtures();
    }

    /**
     * Adds a new fixture to be loaded.
     */
    protected function addFixture(FixtureInterface $fixture): void
    {
        $this->getFixtureLoader()->addFixture($fixture);
    }

    /**
     * Executes all the fixtures that have been loaded so far.
     */
    protected function executeFixtures(): void
    {
        $this->getFixtureExecutor()->execute($this->getFixtureLoader()->getFixtures());
    }

    private function getFixtureExecutor(): ORMExecutor
    {
        if (! $this->fixtureExecutor) {
            /** @var EntityManagerInterface $entityManager */
            $entityManager = $this->app->get(EntityManagerInterface::class);
            $this->fixtureExecutor = new ORMExecutor($entityManager, new ORMPurger($entityManager));
        }

        return $this->fixtureExecutor;
    }

    private function getFixtureLoader(): FixtureLoader
    {
        if (! $this->fixtureLoader) {
            $this->fixtureLoader = new FixtureLoader();
        }

        return $this->fixtureLoader;
    }
}
