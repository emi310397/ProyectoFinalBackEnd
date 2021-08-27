<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Assignment;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Assignment\CreateAssignmentAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreateAssignmentActionTest extends ApiTestCase
{
    protected array $testValues = [
        "task" => 1,
        "studentGroups" => [
            1,
            2,
            3
        ],
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateAssignmentAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('task');
        $this->unsetTestValue('studentGroups');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateAssignmentAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
