<?php

namespace Tests\Unit\Application\Services\Encrypt;

use Application\Services\Encrypt\EncryptService;
use Tests\Unit\UnitTestCase;

class EncryptServiceTest extends UnitTestCase
{
    /**
     * @var EncryptService
     */
    private $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = self::autoInjectMocks(EncryptService::class);
    }

    public function testIfCanEncrypt(): void
    {
        $encrypted = $this->sut->encryptPassword('value');
        $this->assertNotEquals($encrypted, 'value');
    }

    public function testIfCanCompareTwoEqualPasswords(): void
    {
        $unencryptedPassword = 'value';
        $encrypted = $this->sut->encryptPassword($unencryptedPassword);
        $result = $this->sut->comparePasswords($unencryptedPassword, $encrypted);
        $this->assertTrue($result);
    }

    public function testIfCanCompareTwoDifferentPasswords(): void
    {
        $unencryptedPassword = 'value';
        $encrypted = $this->sut->encryptPassword($unencryptedPassword);
        $result = $this->sut->comparePasswords('other value', $encrypted);
        $this->assertFalse($result);
    }
}
