<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Builders;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

class CurrentTimestampBuilder
{
    public static function addTimestamps(ClassMetadataBuilder $builder): ClassMetadataBuilder
    {
        $builder->addField(
            'createdAt',
            Types::DATETIME_MUTABLE,
            [
                'nullable' => false,
                'options' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ]
            ]
        );

        $builder->addField(
            'updatedAt',
            Types::DATETIME_MUTABLE,
            [
                'nullable' => false,
                'options' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ]
            ]
        );

        return $builder;
    }
}
