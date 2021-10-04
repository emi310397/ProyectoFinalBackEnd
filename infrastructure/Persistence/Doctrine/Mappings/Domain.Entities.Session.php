<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\User;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('sessions');
$builder->createField('id', Types::INTEGER)
    ->makePrimaryKey()
    ->generatedValue()
    ->build();

$builder->createManyToOne('user', User::class)
    ->build();

$builder->createManyToOne('user', User::class)
    ->addJoinColumn('user_id', 'id', false)
    ->build();

$builder->addField('hash', Types::TEXT);

$builder->addField('expired', Types::BOOLEAN);

CurrentTimestampBuilder::addTimestamps($builder);
