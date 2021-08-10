<?php

namespace Domain\Traits;

trait IdentityTrait
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}
