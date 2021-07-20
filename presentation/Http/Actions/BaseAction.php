<?php

namespace Presentation\Http\Actions;

use Application\ValueObjects\HttpStatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Presentation\Http\Enums\ResponseCodes;

abstract class BaseAction
{
    protected int $statusCode = HttpStatusCode::OK;
    protected ?string $newSession = null;
    protected ?string $newRenovateHash = null;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function withStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function withNewSession(): void
    {
        if (request()->headers->get('newSession')) {
            $this->newSession = request()->headers->get('newSession');
        }

        if (request()->headers->get('newRenovateHash')) {
            $this->newRenovateHash = request()->headers->get('newRenovateHash');
        }
    }

    public function respondWithSuccess(array $data = [], string $message = 'Success'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::OK)
            ->respondWithArray(
                [
                    'code' => ResponseCodes::CODE_SUCCESS,
                    'http_code' => HttpStatusCode::OK,
                    'message' => $message,
                    'data' => $data
                ]
            );
    }

    protected function respondWithArray(array $array, array $headers = []): JsonResponse
    {
        $this->withNewSession();
        return Response::json(
            $array,
            $this->statusCode,
            $headers + [
                'newSession' => $this->newSession,
                'newRenovateHash' => $this->newRenovateHash
            ]
        );
    }

    public function respondWithCreated(array $data = [], string $message = 'Created'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::CREATED)
            ->respondWithArray(
                [
                    'code' => ResponseCodes::CODE_CREATED,
                    'http_code' => HttpStatusCode::CREATED,
                    'message' => $message,
                    'data' => $data,
                    'newSession' => $this->newSession
                ]
            );
    }

    public function respondWithAccepted(
        array $data = [],
        ?string $newSession = null,
        string $message = 'Accepted'
    ): JsonResponse {
        return $this->withStatusCode(HttpStatusCode::ACCEPTED)
            ->respondWithArray(
                [
                    'code' => ResponseCodes::CODE_SUCCESS,
                    'http_code' => HttpStatusCode::ACCEPTED,
                    'message' => $message,
                    'data' => $data,
                    'newSession' => $newSession
                ]
            );
    }

    public function errorForbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::FORBIDDEN)
            ->respondWithError($message, ResponseCodes::CODE_FORBIDDEN);
    }

    protected function respondWithError(string $errorMessage, string $status): JsonResponse
    {
        if ($this->statusCode === HttpStatusCode::OK) {
            trigger_error(
                'You better have a really good reason for throw an error on a 200...',
                E_USER_WARNING
            );
        }

        return $this->respondWithArray(
            [
                'status' => $status,
                'http_code' => $this->statusCode,
                'message' => $errorMessage,
            ]
        );
    }

    protected function respondWithErrors(string $message, array $errors, string $status): JsonResponse
    {
        if ($this->statusCode === HttpStatusCode::OK) {
            trigger_error(
                'You better have a really good reason for throw an error on a 200...',
                E_USER_WARNING
            );
        }

        return $this->respondWithArray(
            [
                'status' => $status,
                'http_code' => $this->statusCode,
                'message' => $message,
                'errors' => $errors,
            ]
        );
    }

    public function errorInternalError(string $message = 'Internal Error'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::INTERNAL_ERROR)
            ->respondWithError($message, ResponseCodes::CODE_INTERNAL_ERROR);
    }

    public function errorNotFound(string $message = 'Resource Not Found'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::NOT_FOUND)
            ->respondWithError($message, ResponseCodes::CODE_NOT_FOUND);
    }

    public function errorUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::UNAUTHORIZED)
            ->respondWithError($message, ResponseCodes::CODE_UNAUTHORIZED);
    }

    public function errorWrongArgs(array $errors): JsonResponse
    {
        return $this->withStatusCode(HttpStatusCode::BAD_REQUEST)
            ->respondWithErrors('Please check this errors', $errors, ResponseCodes::CODE_WRONG_ARGS);
    }
}
