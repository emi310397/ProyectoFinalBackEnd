<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Course;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Course\GetCoursesAction;
use Presentation\Http\Enums\HttpHeaders;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\SessionFixture;

class GetCoursesActionTest extends ApiTestCase
{
    public function testWithTeacherOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetCoursesAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testWithStudentOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::GET)
            ->route(GetCoursesAction::ROUTE_NAME)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::STUDENT_1_SESSION_2)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }
}
