<?php

namespace App\Http\Controllers\V1\Admin\BannedUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannedUser\StoreBannedUserRequest;
use App\Http\Requests\Admin\BannedUser\UpdateBannedUserRequest;
use App\Http\Resources\V1\Admin\BannedUser\BannedUserResource;
use App\Models\BannedUser;

class BannedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BannedUserResource::collection(BannedUser::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannedUserRequest $request)
    {
        return BannedUserResource::make(BannedUser::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(banneduser $bannedUser)
    {
        return BannedUserResource::make($bannedUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannedUserRequest $request, BannedUser $bannedUser)
    {
        return BannedUserResource::make($bannedUser->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannedUser $bannedUser)
    {
        $bannedUser->delete();
        return response()->noContent();
    }
}
