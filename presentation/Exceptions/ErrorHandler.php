<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

use Application\Exceptions\DomainException;
use Application\Exceptions\DomainRuntimeException;
use Application\Exceptions\ExistingEntityException;
use Application\Exceptions\InvalidTokenTypeException;
use Application\ValueObjects\HttpStatusCode;
use Doctrine\ORM\EntityNotFoundException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use LogicException;
use Presentation\Http\Enums\ResponseCodes;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class ErrorHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        DomainException::class,
        DomainRuntimeException::class,
        InvalidArgumentException::class,
        InvalidBodyException::class,
        InvalidTokenTypeException::class,
        NotFoundHttpException::class,
        EntityNotFoundException::class,
        NotFoundException::class,
        MethodNotAllowedHttpException::class,
        Exception::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if (!$request->wantsJson()) {
            return parent::render($request, $e);
        }

        $error = [];
        $errorMessage = $e->getMessage();
        $errorFile = $e->getFile();
        $errorLine = $e->getLine();
        $errorTrace = $e->getTrace();
        $requestUri = $request->getRequestUri();
        $sensitiveFieldsFilter = new SensitiveFieldsFilter();
        $jsonInput = $sensitiveFieldsFilter->filter($request->json()->all());

        if ($request->attributes->get('user')) {
            $user = $request->attributes->get('user');
            $userData = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'roles' => $user->getRoles(),
                'organization' => $user->getOrganization()->getSlug()
            ];
        } else {
            $userData = [];
        }

        if (config('app.env') !== 'production') {
            $error = [
                'message' => $errorMessage,
                'file' => $errorFile,
                'line' => $errorLine,
                'trace' => $errorTrace,
                'user' => $userData,
                'request_uri' => $requestUri,
                'json_input' => $jsonInput

            ];
        }

        if ($request->attributes->get('newSession')) {
            $newSession = $request->attributes->get('newSession');
        } else {
            $newSession = null;
        }

        if ($e instanceof InvalidBodyException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_WRONG_ARGS,
                HttpStatusCode::UNPROCESSABLE_ENTITY,
                $newSession,
                $e->getErrors(),
                $e->getMessage()
            );
        }

        if ($e instanceof InvalidArgumentException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_WRONG_ARGS,
                HttpStatusCode::BAD_REQUEST,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_NOT_FOUND,
                HttpStatusCode::NOT_FOUND,
                $newSession,
                $error,
                __('Route not found')
            );
        }

        if ($e instanceof DomainException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_UNAUTHORIZED,
                HttpStatusCode::UNAUTHORIZED,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof DomainRuntimeException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_CONFLICT,
                HttpStatusCode::CONFLICT,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof UnprocessableEntityHttpException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_WRONG_ARGS,
                HttpStatusCode::UNPROCESSABLE_ENTITY,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof ExistingEntityException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_CONFLICT,
                HttpStatusCode::CONFLICT,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof RuntimeException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_CONFLICT,
                HttpStatusCode::CONFLICT,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof EntityNotFoundException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_NOT_FOUND,
                HttpStatusCode::NOT_FOUND,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof NotFoundException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_NOT_FOUND,
                HttpStatusCode::NOT_FOUND,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_METHOD_NOT_ALLOWED,
                HttpStatusCode::METHOD_NOT_ALLOWED,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        if ($e instanceof LogicException) {
            return $this->getErrorJSONResponse(
                ResponseCodes::CODE_UNAUTHORIZED,
                HttpStatusCode::UNAUTHORIZED,
                $newSession,
                $error,
                $e->getMessage()
            );
        }

        return $this->getErrorJSONResponse(
            ResponseCodes::CODE_INTERNAL_ERROR,
            HttpStatusCode::INTERNAL_ERROR,
            $newSession,
            $error,
            __('Oops! Something went wrong')
        );
    }

    private function getErrorJSONResponse(
        string $responseCode,
        int $httpStatusCode,
        ?string $newSession = null,
        array $errors = [],
        string $message = 'Error'
    ): JsonResponse {
        $data = [
            'status' => $responseCode,
            'http_code' => $httpStatusCode,
            'newSession' => $newSession,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $data['errors'] = $errors;
        }

        return new JsonResponse($data, $httpStatusCode);
    }
}
