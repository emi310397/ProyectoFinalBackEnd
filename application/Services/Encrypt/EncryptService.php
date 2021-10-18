<?php

declare(strict_types=1);

namespace Application\Services\Encrypt;

use Illuminate\Support\Facades\Hash;

class EncryptService
{
    public function encryptPassword(string $password): string
    {
        return Hash::make($password);
    }

    public function comparePasswords(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
