<?php

namespace App\Services\V1\Contracts;

interface AuthServiceInterface
{
    public function createTokenForUser($user): array;
    public function checkAuthUser(array $user);
}
