<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Student;
use Domain\Entities\Task;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('assignments');

$builder->createManyToOne('task', Task::class)
    ->inversedBy('assignments')
    ->build();

$builder->createManyToMany('students', Student::class)
    ->build();

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
