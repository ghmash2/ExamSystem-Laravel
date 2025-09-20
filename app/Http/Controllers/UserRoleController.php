<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function show(User $user)
    {
        return ApiResponseClass::sendResponse($user, "User roles fetched successfully", 200);
    }

    /**
     * Assign a single new role to a user.
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        // Spatie's assignRole method handles attaching the role via the pivot table
        $user->assignRole($validated['role']);

        return ApiResponseClass::sendResponse($user, "Role assigned successfully", 200);
    }

    /**
     * Update/Sync a user's roles, replacing existing ones with a new set.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        // syncRoles replaces all old roles with the new set
        $user->syncRoles($validated['roles']);

        return ApiResponseClass::sendResponse($user, "User roles updated successfully", 201);
    }

    /**
     * Delete a specific role from a user.
     */
    public function destroy(User $user, string $role)
    {
        // Spatie's removeRole detaches the specified role
        $user->removeRole($role);

        return ApiResponseClass::sendResponse($user, "Role removed successfully", 200);
    }
}
