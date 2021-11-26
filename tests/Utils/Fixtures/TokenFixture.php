<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Domain\Entities\Session;
use Domain\Entities\Token;
use Domain\Enums\TokenTypes;

class TokenFixture extends Fixture
{
    public const TOKEN_1 = 'token_1';
    public const TOKEN_2 = 'token_2';
    public const EXPIRED_TOKEN_3 = 'token_3';

    public function load(ObjectManager $manager): void
    {
        array_map([$manager, 'persist'], $this->getInstances());

        $manager->flush();
    }

    public function getInstances(): array
    {
        $token1 = new Token($this->getReference(UserFixture::NON_ACTIVATED_TEACHER_USER), self::TOKEN_1, TokenTypes::ACCOUNT_REGISTER);
        $this->addReference(self::TOKEN_1, $token1);

        $token2 = new Token($this->getReference(UserFixture::NON_ACTIVATED_TEACHER_USER), self::TOKEN_2, TokenTypes::ACCOUNT_REGISTER);
        $this->addReference(self::TOKEN_2, $token2);

        $expiredToken = new Token($this->getReference(UserFixture::TEACHER_USER_1), self::EXPIRED_TOKEN_3, TokenTypes::ACCOUNT_REGISTER);
        $expiredToken->expire();
        $this->addReference(self::EXPIRED_TOKEN_3, $expiredToken);

        return [
            $token1,
            $token2,
            $expiredToken,
        ];
    }
}
