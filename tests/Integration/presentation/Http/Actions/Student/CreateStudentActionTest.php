<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Student;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Student\CreateStudentAction;
use Presentation\Http\Enums\HttpHeaders;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;
use Tests\Utils\Fixtures\SessionFixture;

class CreateStudentActionTest extends ApiTestCase
{
    protected array $testValues = [
        "firstName" => 'FirstName',
        "lastName" => 'LastName',
        "email" => "studentemail@test.com",
        "password" => "an_awesome_password",
        "confirmationUrl" => "http://localhost:8081/#/confirm",
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateStudentAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithExistentStudent(): void
    {
        $this->setTestValues(
            [
                "email" => "student1@example.com",
            ]
        );

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateStudentAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withHeader(HttpHeaders::AUTHORIZATION, SessionFixture::TEACHER_1_SESSION_1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNAUTHORIZED);
    }
}
