<?php

namespace App\Http\Controllers\V1\ClientSide\Community;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSide\Community\CommunityRequest;
use App\Http\Resources\V1\ClientSide\Community\CommunityResource;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CommunityResource::collection(Community::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityRequest $request)
    {
        $validated = $request->validated();

        $validated['category_id'] = 1;

        Community::create($validated);

        return response()->json(['message' => 'Success creating community group'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        return new CommunityResource($community);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Community $community)
    {
        $validated = $request->validated();

        $community->update($validated);

        return response()->json(['message' => 'Success creating community group'], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        $community->delete();

        $community->posts()->delete();

        return response()->noContent();
    }

    public function subscribe(Community $community)
    {
        $this->authorize('subscribe', $community);
        auth()->user()->subscribed()->attach($community);
    }
    public function unsubscribe(Community $community)
    {
        $this->authorize('unsubscribe', $community);
        auth()->user()->subscribed()->detach($community);
    }
}
