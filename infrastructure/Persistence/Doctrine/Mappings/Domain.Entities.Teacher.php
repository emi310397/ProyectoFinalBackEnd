<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Domain\Entities\Course;

/** @psalm-suppress UndefinedGlobalVariable */
$builder = new ClassMetadataBuilder($metadata);
$builder->setTable('users');

$builder->createOneToMany('courses', Course::class)
    ->mappedBy('teacher')
    ->build();
