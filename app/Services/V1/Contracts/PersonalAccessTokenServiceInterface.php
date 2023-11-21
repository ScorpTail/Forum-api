<?php

namespace App\Services\V1\Contracts;

use App\Models\User;

interface PersonalAccessTokenServiceInterface
{
    public function checkUserExist($validationData): User;
}
