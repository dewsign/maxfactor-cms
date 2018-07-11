<?php

namespace Maxfactor\CMS\Http\Admin\Controllers;

use Maxfactor\CMS\Models\Role;
use Silvanite\Brandenburg\Policy;
use Maxfactor\CMS\Http\Controllers\Controller;
use Maxfactor\CMS\Http\Admin\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Display a listing of permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions()
    {
        return Policy::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
        ]);

        $role->setPermissions(
            array_wrap($request['permissions'])
        );

        $role->save();

        return response([
            'message' => __('Successfully created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id  Role ID
     * @return \Illuminate\Http\Response
     */
    public function show(string $locale, $id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Silvanite\Brandenburg\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role, string $locale = null)
    {
        $role->fill([
            'name' => $request['name'],
            'slug' => $request['slug'],
        ]);

        $role->setPermissions(
            array_wrap($request['permissions'])
        );

        $role->save();

        return response([
            'message' => __('Successfully updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Silvanite\Brandenburg\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, string $locale = null)
    {
        $role->delete();

        return response([
            'message' => __('Successfully deleted'),
        ]);
    }
}
