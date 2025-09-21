<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class DepartmentController extends BaseController
{
    public function __construct() {
        $this->middleware('permission:manage_department')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $depts = Department::all();
        return ApiResponseClass::sendResponse(DepartmentResource::collection($depts), 'All Dept List find Successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
         $validated = $request->validated();
         $department = Department::create($validated);
         return ApiResponseClass::sendResponse(new DepartmentResource($department), 'New Department created', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $department = Department::findOrFail($id);
        return ApiResponseClass::sendResponse(new DepartmentResource($department), 'Find Department Successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, $id)
    {
        $validated = $request->validated();
        $dept = Department::findOrFail($id);
        $dept->update($validated);
        return ApiResponseClass::sendResponse(new DepartmentResource($dept), 'dept Update Successful', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dept = Department::findOrFail($id);
        $dept->delete();
        return ApiResponseClass::sendResponse(new DepartmentResource($dept), 'Department Deleted Successfully', 200);
    }
}
