<?php

namespace Tests\Utils\Objects;

class ApiTestRequest
{
    private string $httpMethod;
    private string $route;
    private array $body;
    private array $headers;
    private array $cookies;

    public function __construct(
        string $method,
        string $route,
        array $queryParams,
        array $body,
        array $headers,
        array $cookies
    ) {
        $this->httpMethod = $method;
        $this->route = route($route, $queryParams);
        $this->body = $body;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    public function getMethod(): string
    {
        return $this->httpMethod;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }
}
