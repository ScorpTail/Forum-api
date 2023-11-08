<?php

namespace App\Http\Controllers\V1\Admin\BannedUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannedUser\StoreBannedUserRequest;
use App\Http\Requests\BannedUser\UpdateBannedUserRequest;
use App\Models\BannedUser;

class BannedUserController extends Controller
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
    public function store(StoreBannedUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(banneduser $bannedUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannedUserRequest $request, BannedUser $bannedUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BannedUser $bannedUser)
    {
        //
    }
}
