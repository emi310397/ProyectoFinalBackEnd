<?php

declare(strict_types=1);

namespace Tests\Utils\Fixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;

class FixturesProvider
{
    /** @var FixtureInterface[] */
    private static array $fixtures = [];

    public static function get(): array
    {
        if (empty(self::$fixtures)) {
            self::loadFixtures();
        }

        return self::$fixtures;
    }

    private static function loadFixtures(): void
    {
        self::$fixtures = [
            new UserFixture(),
        ];
    }
}
