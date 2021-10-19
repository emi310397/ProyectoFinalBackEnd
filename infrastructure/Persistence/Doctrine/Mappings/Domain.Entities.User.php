<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Student;
use Domain\Entities\Teacher;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('users');

$builder->createField('firstName', Types::STRING)
    ->build();

$builder->createField('lastName', Types::STRING)
    ->build();

$builder->createField('email', Types::TEXT)
    ->build();

$builder->createField('password', Types::TEXT)
    ->build();

$builder->createField('status', Types::INTEGER)
    ->build();

$builder->setSingleTableInheritance()
    ->setDiscriminatorColumn('rol', Types::STRING)
    ->addDiscriminatorMapClass('teacher', Teacher::class)
    ->addDiscriminatorMapClass('student', Student::class);

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
