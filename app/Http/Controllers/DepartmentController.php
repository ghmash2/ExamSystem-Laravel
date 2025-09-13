<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $department = Department::find($id);
        return ApiResponseClass::sendResponse(new DepartmentResource($department), 'Single Department', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
