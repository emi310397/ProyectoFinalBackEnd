<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Entities;

use Common\utils\ClassFinder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class EntityMetadataBuilder
{
    private const ENTITIES_PATH = 'domain/Entities';
    
    private EntityManagerInterface $em;
    private ClassFinder $finder;
    
    public function __construct(EntityManagerInterface $em, ClassFinder $classFinder)
    {
        $this->em = $em;
        $this->finder = $classFinder;
    }
    
    public function buildFor(string $entity): ClassMetadata
    {
        return $this->em->getClassMetadata($entity);
    }

    /**
     * @return ClassMetadata[]
     */
    public function buildAll(): array
    {
        $entities = $this->finder->findClasses(base_path() . '/' . self::ENTITIES_PATH);
        
        return array_map([$this, 'buildFor'], $entities);
    }
}
