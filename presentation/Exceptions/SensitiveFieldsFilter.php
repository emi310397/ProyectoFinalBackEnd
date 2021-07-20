<?php

declare(strict_types=1);

namespace Presentation\Exceptions;

class SensitiveFieldsFilter
{
    public function filter(array $params): array
    {
        $filteredParams = [];
        foreach ($params as $key => $param){
            $filteredParams[$key] = $param;
            if (in_array($key, $this->getFilteredParamNames(), true)){
                $filteredParams[$key] = '********';
            }
        }
        return $filteredParams;
    }

    private function getFilteredParamNames(): array
    {
        return [
            'password',
            'old-password',
            'oldPassword',
            'confirmPassword',
            'confirm-password',
            'new-password',
            'newPassword',
            'credit-card',
            'creditCard',
        ];
    }
}
