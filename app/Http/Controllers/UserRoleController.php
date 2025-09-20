<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_roles = UserRole::all();
       return ApiResponseClass::sendResponse($user_roles, "All user_roles find successfully", 200);
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
        $request->validate(['user_id' => 'required', 'role_id' => 'required']);
        $user_role = UserRole::create($request->all());
        return ApiResponseClass::sendResponse($user_role, "user_role created successfully", 200);
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
    public function update(Request $request, UserRole $userRole)
    {
       $userRole->update($request->all());
       $userRole->refresh;
       return ApiResponseClass::sendResponse($userRole, "user_role updated successfully", 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $userRole)
    {
       $userRole->delete();
       return ApiResponseClass::sendResponse($userRole, "user_role deleted successfully", 200);
    }
}
