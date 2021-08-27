<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Assignment;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Assignment\GetAssignmentAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class GetAssignmentActionTest extends ApiTestCase
{
    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetAssignmentAction::ROUTE_NAME)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithInvalidId(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetAssignmentAction::ROUTE_NAME)
            ->withQueryParam('id', -1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithoutId(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetAssignmentAction::ROUTE_NAME)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
