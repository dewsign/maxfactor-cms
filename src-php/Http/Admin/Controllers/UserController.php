<?php

namespace Maxfactor\CMS\Http\Admin\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maxfactor\CMS\Http\Controllers\Controller;
use Maxfactor\CMS\Http\Admin\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::withRoles()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make(str_random()),
        ]);

        $user->setRolesById(
            array_wrap($request['roles'])
        );

        $user->save();

        return response([
            'message' => __('Successfully created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $locale, int $id)
    {
        return User::withRoles()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, string $locale = null)
    {
        $user->fill([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        $user->setRolesById(
            array_wrap($request['roles'])
        );

        $user->save();

        return response([
            'message' => __('Successfully updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, string $locale = null)
    {
        $user->delete();

        return response([
            'message' => __('Successfully deleted'),
        ]);
    }

    /**
     * Get the current user from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function current()
    {
        return Auth::user()
            ->withRoles()
            ->first()
            ->toArray();
    }
}
