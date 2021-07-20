<?php

namespace Tests\Utils\Traits\Builders;

use Presentation\Http\Enums\HttpMethods;
use Tests\Utils\Objects\ApiTestRequest;

trait RequestBuilderTrait
{
    private $httpMethod;
    private $routeName;
    private $queryParams = [];
    private $headers = [];
    private $body = [];
    private $cookies = [];

    public static function request(): self
    {
        return new self();
    }

    public function build(): ApiTestRequest
    {
        return new ApiTestRequest(
            $this->httpMethod,
            $this->routeName,
            $this->queryParams,
            $this->body,
            $this->headers,
            $this->cookies
        );
    }

    public function method(string $method): self
    {
        HttpMethods::assertContains($method);

        $this->httpMethod = $method;

        return $this;
    }

    public function route(string $route): self
    {
        $this->routeName = $route;

        return $this;
    }

    public function withQueryParam($key, $value): self
    {
        $this->queryParams[$key] = $value;

        return $this;
    }

    public function withHeader($key, $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function withBody(array $body): self
    {
        $this->body = $body;

        return $this;
    }
}
