<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return ApiResponseClass::sendResponse($permissions, "All permissions find successfully", 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name', 'is_active' => 'boolean']);
        $permission = Permission::create($request->all());
        return ApiResponseClass::sendResponse($permission, "permission created successfully", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $permission_id)
    {
       $request->validate(['is_active' => 'boolean']);
       $permission = Permission::findOrFail($permission_id);
       $permission->update($request->all());
       $permission->refresh;
       return ApiResponseClass::sendResponse($permission, "permission updated successfully", 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permission_id)
    {
       $permission = Permission::findOrFail($permission_id);
       $permission->delete();
       return ApiResponseClass::sendResponse($permission, "permission deleted successfully", 200);
    }
}
