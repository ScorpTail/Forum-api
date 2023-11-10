<?php

namespace App\Http\Controllers\V1\Admin\Community;

use App\Http\Controllers\Controller;
use App\Http\Requests\Community\StoreCommunityRequest;
use App\Http\Requests\Community\UpdateCommunityRequest;
use App\Http\Resources\V1\Admin\Community\CommunityResource;
use App\Models\Community;

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
    public function store(StoreCommunityRequest $request)
    {
        return CommunityResource::make($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        return CommunityResource::make($community);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        return CommunityResource::make($community->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        $community->delete();
        return response()->noContent();
    }
}
