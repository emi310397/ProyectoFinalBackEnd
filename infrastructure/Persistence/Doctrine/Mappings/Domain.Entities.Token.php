<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\User;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('tokens');
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

$builder->addField('hash', Types::INTEGER);

$builder->addField('expired', Types::BOOLEAN);

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
