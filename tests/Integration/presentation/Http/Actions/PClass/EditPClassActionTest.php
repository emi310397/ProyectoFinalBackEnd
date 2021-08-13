<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\PClass;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\PClass\EditPClassAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class EditPClassActionTest extends ApiTestCase
{
    protected array $testValues = [
        "subject" => 'Class Title',
        "description" => "This is a class about...",
    ];

    public function testOk(): void
    {
        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditPClassAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->withQueryParam('id', 1)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::OK);
    }

    public function testOkWithNullOptionalData(): void
    {
        $this->unsetTestValue('subject');
        $this->unsetTestValue('description');

        $request = self::request()
            ->method(HttpMethods::PUT)
            ->route(EditPClassAction::ROUTE_NAME)
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
            ->route(EditPClassAction::ROUTE_NAME)
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
            ->route(EditPClassAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
