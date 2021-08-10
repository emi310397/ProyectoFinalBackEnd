<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Builders;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

class IdentityBuilder
{
    public static function addIdField(ClassMetadataBuilder $builder): ClassMetadataBuilder
    {
        $builder->createField('id', Types::INTEGER)
            ->makePrimaryKey()
            ->generatedValue()
            ->build();

        return $builder;
    }
}
