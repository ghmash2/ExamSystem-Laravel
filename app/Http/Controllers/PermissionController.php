<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller as BaseController;
class PermissionController extends BaseController
{
    public function __construct() {
        $this->middleware('permission:create_permission')->only(['store']);
        $this->middleware('permission:edit_permission')->only(['update']);
        $this->middleware('permission:delete_permission')->only(['destroy']);
        $this->middleware('permission:view_permission')->only(['show']);
        $this->middleware('permission:view_permissions')->only(['index']);
          //$this->middleware('permission:manage_permissions')->only(['index', 'store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();

        return ApiResponseClass::sendResponse($permissions, 'All permissions find successfully', 200);
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
        $request->validate(['name' => 'required|unique:permissions,name']);
        $permission = Permission::create(['name' => $request->name, 'guard_name' => 'api']);

        return ApiResponseClass::sendResponse($permission, 'permission created successfully', 200);
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
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);
        $permission->update($request->all());
        $permission->refresh();

        return ApiResponseClass::sendResponse($permission, 'permission updated successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permissions)
    {
        $permissions->delete();
        return ApiResponseClass::sendResponse([], 'permission deleted successfully', 200);
    }
}
