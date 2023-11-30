<?php

namespace App\Policies\V1;

use App\Models\Community;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommunityPolicy
{
    public function subscribe(User $user, Community $community): bool|Response
    {
        return !$community->isSubscriber($user);
    }

    public function unsubscribe(User $user, Community $community): bool|Response
    {
        return $community->isSubscriber($user);
    }
}
