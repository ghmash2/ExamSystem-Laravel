<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role_permissions = RolePermission::all();
       return ApiResponseClass::sendResponse($role_permissions, "All role_permissions find successfully", 200);
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
        $request->validate(['role_id' => 'required']);
        $role_permission = RolePermission::create($request->all());
        return ApiResponseClass::sendResponse($role_permission, "role_permission created successfully", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RolePermission $rolePermission)
    {
       $rolePermission->update($request->all());
       $rolePermission->refresh;
       return ApiResponseClass::sendResponse($rolePermission, "role_permission updated successfully", 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolePermission)
    {
       $rolePermission->delete();
       return ApiResponseClass::sendResponse($rolePermission, "role_permission deleted successfully", 200);
    }
}
