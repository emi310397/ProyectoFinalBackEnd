<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\StudentGroup;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\StudentGroup\CreateStudentGroupAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreateStudentGroupActionTest extends ApiTestCase
{
    protected array $testValues = [
        "name" => 'Class Title',
        "description" => "This is a class about...",
        "courseId" => 1,
        "students" => [
            1,
            2,
            3
        ],
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('name');
        $this->unsetTestValue('description');
        $this->unsetTestValue('courseId');
        $this->unsetTestValue('students');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
