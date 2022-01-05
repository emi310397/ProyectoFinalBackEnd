<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\User;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\User\GetCurrentUserAction;
use Presentation\Http\Enums\HttpHeaders;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\SessionFixture;

class GetCurrentUserActionTest extends ApiTestCase
{
    public function testOkWithTeacher(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetCurrentUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testOkWithStudent(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetCurrentUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::STUDENT_1_SESSION_2)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithExpiredSession(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetCurrentUserAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::STUDENT_2_EXPIRED_SESSION_3)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }
}
