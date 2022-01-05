<?php

declare(strict_types=1);

namespace Tests\Integration\presentation\Http\Actions\Activity;

use Application\ValueObjects\HttpStatusCode;
use Presentation\Http\Actions\Activity\CreateActivityAction;
use Presentation\Http\Enums\HttpMethods;
use Tests\Integration\ApiTestCase;

class CreateActivityActionTest extends ApiTestCase
{
    protected array $testValues = [
        "title" => 'activity',
        "type" => 1,
        "description" => 'some description about the activity',
        "body" => "",
        "task" => 1,
    ];

    private function setValidExampleJsonToTestValues()
    {
        $jsonData = json_encode(
            "[
  {
    id: 1,
    question: 'Pregunta 1',
    type: 1,
    options: [
      {
        answer: 'Opción respuesta 1',
        isRight: false
      },
      {
        answer: 'Opción respuesta 2',
        isRight: true
      },
      {
        answer: 'Opción respuesta 3',
        isRight: false
      }
    ]
  },
  {
    id: 2,
    question: 'Pregunta 1',
    type: 2,
    correct: true,
  },
  {
    id: 3,
    question: 'Pregunta 1',
    type: 3,
  },
]",
            JSON_THROW_ON_ERROR
        );

        $this->setTestValues(['body' => $jsonData]);
    }

    public function testOk(): void
    {
        $this->setValidExampleJsonToTestValues();
        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateActivityAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::CREATED);
    }

    public function testShouldFailMissingRequiredData(): void
    {
        $this->unsetTestValue('body');

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateActivityAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }

    public function testShouldFailWithInvalidBody(): void
    {
        $jsonData = json_encode(
        "[
  {
    id: 1,
    question: 'Pregunta 1',
    type: 1,
    options: [
      {
        answer: 'Opción respuesta 1',
        isRight: false
      },
      {
        answer: 'Opción respuesta 2',
        isRight: true
      },
      {
        answer: 'Opción respuesta 3',
]",
        JSON_THROW_ON_ERROR
    );

        $this->setTestValues(['body' => $jsonData]);

        $request = self::request()
            ->method(HttpMethods::POST)
            ->route(CreateActivityAction::ROUTE_NAME)
            ->withBody($this->testValues)
            ->build();

        $response = $this->execute($request);

        $response->assertStatus(HttpStatusCode::UNPROCESSABLE_ENTITY);
    }
}
