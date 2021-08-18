<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\PClass;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\PClass\GetPClassesAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class GetPClassesActionTest extends ApiTestCase
{
    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetPClassesAction::ROUTE_NAME)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithInvalidId(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetPClassesAction::ROUTE_NAME)
            ->withQueryParam('id', -1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithoutId(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetPClassesAction::ROUTE_NAME)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
