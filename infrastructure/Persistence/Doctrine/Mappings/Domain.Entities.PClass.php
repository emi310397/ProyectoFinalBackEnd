<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Course;
use Domain\Entities\Task;
use Domain\Entities\User;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('classes');

$builder->createManyToOne('course', Course::class)
    ->inversedBy('classes')
    ->build();

$builder->createField('subject', Types::TEXT)
    ->build();

$builder->createField('description', Types::TEXT)
    ->build();

$builder->createManyToMany('users', User::class)
    ->build();

$builder->createField('fromDate', Types::DATE_IMMUTABLE)
    ->build();

$builder->createField('toDate', Types::DATE_IMMUTABLE)
    ->build();

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
