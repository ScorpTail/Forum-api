<?php

namespace App\Services\V1\Contracts;

use App\Models\User;

interface ProviderSocialiteServiceInterface
{
    public function getRedirectProvider(string $provider);

    public function getUserProviderDriver(string $provider);

    public function createOrUpdateUser(string $provider, $socialUser): User;
}
