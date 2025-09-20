<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $roles = Role::all();
       return ApiResponseClass::sendResponse($roles, "All roles find successfully", 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        $role = Role::create(['name' => $request->name, 'guard_name'=>'api']);
        return ApiResponseClass::sendResponse($role, "role created successfully", 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $roles)
    {
       $roles->update($request->all());
       $roles->refresh;
       return ApiResponseClass::sendResponse($roles, "role updated successfully", 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role_id)
    {
       $role = Role::findOrFail($role_id);
       $role->delete();
       return ApiResponseClass::sendResponse($role, "role deleted successfully", 200);
    }
}
