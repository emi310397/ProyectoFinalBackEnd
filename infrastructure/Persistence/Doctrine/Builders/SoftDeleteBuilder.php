<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Builders;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;

class SoftDeleteBuilder
{
    public static function addSoftDelete(ClassMetadataBuilder $builder): ClassMetadataBuilder
    {
        $builder->addField(
            'deletedAt',
            Types::DATETIME_MUTABLE,
            [
                'nullable' => true,
                'options' => [
                    'default' => null
                ]
            ]
        );

        return $builder;
    }
}
