<?php

namespace App\Services\V1\Contracts;

interface AuthServiceInterface
{
    public function createTokenForUser($user): string;
    public function checkAuthUser(array $user);
}
