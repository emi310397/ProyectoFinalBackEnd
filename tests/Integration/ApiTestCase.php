<?php

namespace Tests\Integration;

use Application\ValueObjects\HttpStatusCode;
use Illuminate\Testing\TestResponse;
use Presentation\Http\Enums\ResponseCodes;
use Tests\Utils\Objects\ApiTestRequest;
use Tests\Utils\Traits\Builders\RequestBuilderTrait;

class ApiTestCase extends IntegrationTestCase
{
    use RequestBuilderTrait;

    protected array $testValues = [];

    protected function setTestValues(array $data): void
    {
        $this->testValues = array_merge($this->testValues, $data);
    }

    protected function unsetTestValue(string $param): void
    {
        unset($this->testValues[$param]);
    }

    protected function execute(ApiTestRequest $request): TestResponse
    {
        $content = json_encode($request->getBody(), JSON_THROW_ON_ERROR);
        $headers = array_merge(
            [
                'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
                'CONTENT_TYPE' => 'application/json',
                'Accept' => 'application/json',
            ]
            , $request->getHeaders());

        return $this->call(
            $request->getMethod(),
            $request->getRoute(),
            [],
            $request->getCookies(),
            [],
            $this->transformHeadersToServerVars($headers),
            $content
        );

    }

    protected function assertErrorHasMessage(TestResponse $response): void
    {
        $response->isClientError();
        $responseBody = $response->decodeResponseJson();

        $this->assertArrayHasKey('message', $responseBody);
        $this->assertNotEmpty($responseBody['message']);
    }

    protected function assertValidationErrorBody(TestResponse $response): void
    {
        $response->isClientError();
        $responseBody = $response->decodeResponseJson();

        $this->assertArrayHasKey('status', $responseBody);
        $this->assertArrayHasKey('http_code', $responseBody);
        $this->assertArrayHasKey('message', $responseBody);
        $this->assertArrayHasKey('errors', $responseBody);

        $this->assertEquals(ResponseCodes::CODE_WRONG_ARGS, $responseBody['status']);
        $this->assertEquals(HttpStatusCode::UNPROCESSABLE_ENTITY, $responseBody['http_code']);

        $this->assertNotEmpty($responseBody['errors']);
    }

    protected function assertValidationErrorBodyOnFields(TestResponse $response, array $errorFields): void
    {
        $this->assertValidationErrorBody($response);

        $responseBody = $response->decodeResponseJson();

        foreach ($errorFields as $errorField) {
            $this->assertArrayHasKey($errorField, $responseBody['errors']);
        }
    }
}
