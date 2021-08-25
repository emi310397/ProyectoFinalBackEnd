<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\PClass;
use Domain\Entities\StudentGroup;
use Domain\Entities\Teacher;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('courses');

$builder->createField('title', Types::TEXT)
    ->build();

$builder->createField('description', Types::TEXT)
    ->build();

$builder->createOneToOne('teacher', Teacher::class)
    ->cascadePersist()
    ->build();

$builder->createManyToMany('students', StudentGroup::class)
    ->cascadePersist()
    ->build();

$builder->createOneToMany('classes', PClass::class)
    ->mappedBy('course')
    ->build();

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
