<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller as BaseController;
class RolePermissionController extends BaseController
{
    public function __construct() {
          $this->middleware('permission:manage_role_permissions')->only(['assign', 'update', 'delete']);
          $this->middleware('permission:view_role_permissions')->only(['show']);
    }
    /**
     * Display the specified role and its permissions.
     */
    public function show(Role $role)
    {
        return ApiResponseClass::sendResponse($role->load('permissions'), 'Role permissions fetched successfully', 200);
    }

    /**
     * Assign a single new permission to a role.
     */
    public function assign(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);

        $permission = Permission::findByName($validated['permission'], 'api');
        // dd($role);
        //dd($permission);
        $role->givePermissionTo($permission);

        return ApiResponseClass::sendResponse($role->load('permissions'), 'Permission assigned successfully', 200);
    }

    /**
     * Update/Sync a role's permissions, replacing existing ones with a new set.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        // syncPermissions replaces all old permissions with the new set
        $role->syncPermissions($validated['permissions']);

        return ApiResponseClass::sendResponse($role->load('permissions'), 'Role permissions updated successfully', 201);
    }

    /**
     * Delete a specific permission from a role.
     */
    public function delete(Role $role, string $permission)
    {
        // Spatie's revokePermissionTo detaches the specified permission
        $role->revokePermissionTo($permission);

        return ApiResponseClass::sendResponse($role->load('permissions'), 'Permission removed successfully', 200);
    }
}
