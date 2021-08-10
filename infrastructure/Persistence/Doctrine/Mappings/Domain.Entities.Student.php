<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Infrastructure\Persistence\Doctrine\Builders\CurrentTimestampBuilder;
use Infrastructure\Persistence\Doctrine\Builders\IdentityBuilder;
use Infrastructure\Persistence\Doctrine\Builders\SoftDeleteBuilder;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('student');

SoftDeleteBuilder::addSoftDelete($builder);
CurrentTimestampBuilder::addTimestamps($builder);
IdentityBuilder::addIdField($builder);
