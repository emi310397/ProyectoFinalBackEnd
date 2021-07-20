<?php

namespace Tests\Utils\Traits\Database;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Illuminate\Contracts\Foundation\Application;
use Infrastructure\Persistence\Doctrine\Entities\EntityMetadataBuilder;

trait DatabasePreparerTrait
{
    /** @var Application */
    protected $app;

    /** @var EntityManagerInterface */
    protected $em;

    /** @var EntityMetadataBuilder */
    protected $metadataBuilder;

    private ?SchemaTool $schemaTool = null;

    protected function prepareDatabase(): void
    {
        $this->em = $this->app->get(EntityManagerInterface::class);
        $this->metadataBuilder = $this->app->get(EntityMetadataBuilder::class);

        if (! $this->schemaTool) {
            $this->schemaTool = new SchemaTool($this->em);
        }

        $this->schemaTool->dropDatabase();
        $this->schemaTool->createSchema($this->metadataBuilder->buildAll());
    }
}
