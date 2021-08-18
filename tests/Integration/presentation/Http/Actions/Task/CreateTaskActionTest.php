<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Task;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Task\CreateTaskAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreateTaskActionTest extends ApiTestCase
{
    protected array $testValues = [
        "subject" => 'Task Title',
        "description" => "This is a task about...",
        "fromDate" => "17-07-2021 10:30:00",
        "toDate" => "27-07-2021 10:30:00",
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateTaskAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('subject');
        $this->unsetTestValue('description');
        $this->unsetTestValue('fromDate');
        $this->unsetTestValue('toDate');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateTaskAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
