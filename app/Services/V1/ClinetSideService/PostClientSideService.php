<?php

namespace App\Services\V1\ClinetSideService;

use App\Models\Post;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Requests\ClientSide\Post\UpvoteRequest;
use App\Models\Comment;
use App\Services\V1\Contracts\ClientSideContracts\Post\PostServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PostClientSideService implements PostServiceInterface
{

    public function __construct(private ClientSideService $clientSideService)
    {
    }

    public function storePost($request)
    {
        $validatedData = $this->clientSideService->validationData($request);

        return Post::create($validatedData);
    }
    public function updatePost($request, $post)
    {
        $validatedData = $this->clientSideService->validationData($request);

        return $post->update($validatedData);
    }

    public function destroyPost(Post $post)
    {
        $post->comments()->delete();

        $post->upvotes()->delete();

        $post->delete();

        return true;
    }

    public function upvote(UpvoteRequest $request, Model $model): Post|Comment
    {
        $upvote = $request->validated();

        if ($model->upvotes->contains('user_id', $upvote['user_id'])) {
            if ($model->upvotes()->where('user_id', $upvote['user_id'])->where('upvote', $upvote['upvote'])->exists()) {
                $model->upvotes()->where('user_id', $upvote['user_id'])->delete();
            }
            $model->upvotes()->where('user_id', $upvote['user_id'])->update($upvote);
        } else {
            $model->upvotes()->create($upvote);
        }

        return $model->refresh();
    }

    public function sorting($request)
    {
        $userGroups = $this->checkToken($request);

        $sortBy = $request->get('sort_by', 'popular');

        $query = Post::withCount('upvotes');

        switch ($sortBy) {
            case 'popular':
                $query->orderByDesc('upvotes_count');
                break;
            case 'date':
                $query->orderByDesc('created_at');
                break;
            case 'sub':
                $query->when(isset($userGroups), fn ($q) => $q->whereIn('community_id', $userGroups));
                break;
            default:
                $query->orderByDesc('upvotes_count');
                break;
        }

        $posts = $query->get();

        return $posts;
    }

    private function checkToken($request): Collection|null
    {
        $bearerToken = $request->bearerToken();

        if ($accessToken = PersonalAccessToken::findToken($bearerToken)) {

            if ($accessToken && $accessToken->name !== 'refreshToken') {
                $user = $accessToken->tokenable;
            }

            $userGroups = optional($user)->subscribed->pluck('id');

            return $userGroups;
        }

        return null;
    }
}
