<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\StudentGroup;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\StudentGroup\GetStudentGroupsAction;
use Presentation\Http\Enums\HttpHeaders;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\SessionFixture;

class GetStudentGroupsActionTest extends ApiTestCase
{
    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetStudentGroupsAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithInvalidId(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetStudentGroupsAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->withQueryParam('id', -1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithNotOwningCourse(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetStudentGroupsAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->withQueryParam('id', 2)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }
}
