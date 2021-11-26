<?php

namespace Tests\Integration\presentation\Http\Actions\Auth;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Auth\ConfirmUserAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\TokenFixture;

class ConfirmUserActionTest extends ApiTestCase
{
    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(ConfirmUserAction::ROUTE_NAME)
            ->withQueryParam('hash', TokenFixture::TOKEN_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testMissingParam(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(ConfirmUserAction::ROUTE_NAME)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldThrowExceptionWithAlreadyActivatedUser(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(ConfirmUserAction::ROUTE_NAME)
            ->withQueryParam('hash', TokenFixture::EXPIRED_TOKEN_3)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }
}
