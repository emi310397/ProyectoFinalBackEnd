<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\PClass;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\PClass\CreatePClassAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreatePClassActionTest extends ApiTestCase
{
    protected array $testValues = [
        "subject" => 'Class Title',
        "description" => "This is a class about...",
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreatePClassAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('subject');
        $this->unsetTestValue('description');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreatePClassAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
