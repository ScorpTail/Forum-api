<?php

namespace App\Http\Controllers\V1\Admin\Community;

use App\Http\Controllers\Controller;
use App\Http\Requests\Community\StoreCommunityRequest;
use App\Http\Requests\Community\UpdateCommunityRequest;
use App\Models\Community;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommunityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        //
    }
}
