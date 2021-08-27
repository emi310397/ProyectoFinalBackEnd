<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Assignment;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Assignment\DeleteAssignmentAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class DeleteAssignmentActionTest extends ApiTestCase
{
    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::DELETE)
            ->route(DeleteAssignmentAction::ROUTE_NAME)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithInvalidId(): void
    {
        $request = self::request()
            ->method(HttpMethods::DELETE)
            ->route(DeleteAssignmentAction::ROUTE_NAME)
            ->withQueryParam('id', -1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithoutId(): void
    {
        $request = self::request()
            ->method(HttpMethods::DELETE)
            ->route(DeleteAssignmentAction::ROUTE_NAME)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
