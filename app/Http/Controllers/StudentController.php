<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $students = Student::all();
       return ApiResponseClass::sendResponse(StudentResource::collection($students), 'All Students List find Successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
         $validated = $request->validated();
         $student = Student::create($validated);
         return ApiResponseClass::sendResponse(new StudentResource($student), 'New Student created Successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        return ApiResponseClass::sendResponse(new StudentResource($student), 'Find Student Successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $validated = $request->validated();
        $student->update($validated);
        return ApiResponseClass::sendResponse(new StudentResource($student), 'Student Updated Successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return ApiResponseClass::sendResponse(new StudentResource($student), 'Student Deleted successfully', 200);
    }
}
