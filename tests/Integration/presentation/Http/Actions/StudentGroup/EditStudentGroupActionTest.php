<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\StudentGroup;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\StudentGroup\EditStudentGroupAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class EditStudentGroupActionTest extends ApiTestCase
{
    protected array $testValues = [
        "id" => 1,
        "name" => 'Class Title',
        "description" => "This is a class about...",
        "students" => [
            1,
            3,
            5
        ],
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testOkWithNullOptionalData(): void
    {
        $this->unsetTestValue('name');
        $this->unsetTestValue('description');
        $this->unsetTestValue('courseId');
        $this->unsetTestValue('students');

        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailWithInvalidId(): void
    {
        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withQueryParam('id', -1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithoutId(): void
    {
        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditStudentGroupAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
