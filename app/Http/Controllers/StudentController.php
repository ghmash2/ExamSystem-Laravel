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
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
         $validated = $request->validated();
         $student = Student::create($validated);
         return ApiResponseClass::sendResponse(new StudentResource($student), 'New Student created', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        return ApiResponseClass::sendResponse(new StudentResource($student), 'Single Student', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
