<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Course;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Course\CreateCourseAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreateCourseActionTest extends ApiTestCase
{
    protected array $testValues = [
        "title" => 'Class Title',
        "description" => "This is a class about...",
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateCourseAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('title');
        $this->unsetTestValue('description');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateCourseAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
