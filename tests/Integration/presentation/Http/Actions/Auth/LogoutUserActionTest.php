<?php

namespace Tests\Integration\presentation\Http\Actions\Auth;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Auth\LogoutUserAction;
use Presentation\Http\Enums\HttpHeaders;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\SessionFixture;

class LogoutUserActionTest extends ApiTestCase
{
    public function testWithTeacherSessionOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LogoutUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testWithStudentSessionOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LogoutUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::STUDENT_1_SESSION_2)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testWithStudentExpiredSessionOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(LogoutUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::STUDENT_2_EXPIRED_SESSION_3)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }
}
