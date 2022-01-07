<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Assignment;
use Domain\Entities\Course;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('tasks');

$builder->createManyToOne('course', Course::class)
    ->inversedBy('tasks')
    ->build();

$builder->createField('title', Types::TEXT)
    ->build();

$builder->createField('description', Types::TEXT)
    ->build();

$builder->createField('fromDate', Types::DATE_MUTABLE)
    ->build();

$builder->createField('toDate', Types::DATE_MUTABLE)
    ->build();

$builder->createOneToMany('assignments', Assignment::class)
    ->mappedBy('task')
    ->build();

$builder->createOneToMany('activities', Assignment::class)
    ->mappedBy('task')
    ->build();

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
