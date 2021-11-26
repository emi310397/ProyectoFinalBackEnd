<?php

namespace Domain\Services;

use DateTime;
use Domain\Entities\Token;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Firebase\JWT\JWT;

class CreateTokenService
{
    private TokenRepositoryInterface $tokenRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
    }

    public function handle(User $user, int $tokenType): Token
    {
        $token = new Token($user, $this->generateJWTToken($user), $tokenType);
        $this->tokenRepository->save($token);

        return $token;
    }

    private function generateJWTToken(User $user): string
    {
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();

        $payload = [
            'user' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'roles' => get_class($user)
            ],
            'created_at' => new DateTime()
        ];

        return JWT::encode($payload, config('auth.JWT_KEY'));
    }
}
