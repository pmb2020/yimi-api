<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = User::query()->simplePaginate(20);
        return apiResponse(data: $res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $params = $this->getFormatParams($request);
        $params['password'] = bcrypt($params['password']);
        $params['register_ip'] = $request->getClientIp();
        User::create($params);
        return apiResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->validated())->save();
        return apiResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return apiResponse();
    }

    private function getFormatParams($request): array
    {
        return $request->only('phone','password','nickname');
    }
}
