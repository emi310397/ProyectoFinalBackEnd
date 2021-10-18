<?php

namespace Tests\Integration\presentation\Http\Actions\Auth;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Auth\LoginUserAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class LoginUserActionTest extends ApiTestCase
{
    protected array $testValues = [
        'email' => 'alexturner@example.test',
        'password' => '12345678'
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LoginUserAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testWithWrongPasswordShouldFail(): void
    {
        $this->setTestValues(['password' => 'wrongPassword']);
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LoginUserAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }

    public function testMissingParam(): void
    {
        $this->unsetTestValue('password');
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LoginUserAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldThrowExceptionWithNotActivatedUser(): void
    {
        $this->setTestValues(['email' => 'notactivateduser@example.test']);
        $this->setTestValues(['password' => '12345678']);
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LoginUserAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }

    public function testShouldThrowExceptionWithDisabledUser(): void
    {
        $this->setTestValues(['email' => 'disableduser@example.test']);
        $this->setTestValues(['password' => '12345678']);
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LoginUserAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }
}
