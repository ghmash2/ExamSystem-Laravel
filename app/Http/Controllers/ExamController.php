<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use App\Http\Resources\LauncedExamResource;
use App\Models\Exam;
use App\Models\Question;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Session;
use Illuminate\Routing\Controller as BaseController;
class ExamController extends BaseController
{
    public function __construct() {
        $this->middleware('permission:manage_exam')->only(['index', 'store', 'show', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        // return view('exams.index', compact('exams'));
        return ApiResponseClass::sendResponse(ExamResource::collection($exams), 'All Exam List', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $validated = $request->validated();
        $exam = Exam::create($validated);
        return ApiResponseClass::sendResponse(new ExamResource($exam), 'Exam Create Successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        //$questions = Question::where('exam_id', $exam_id)->with('options')->get();
        return ApiResponseClass::sendResponse(new ExamResource($exam), 'Find Exam Successfully', 200);
        //return view('exams.show', compact('questions', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        // return view('exams.create', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, $exam_id)
    {
        $validated = $request->validated();
        $exam = Exam::findOrFail($exam_id);
        $exam->update($validated);
        return ApiResponseClass::sendResponse(new ExamResource($exam), 'Exam Update Successful', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $exam->delete();
        return ApiResponseClass::sendResponse(new ExamResource($exam), 'Exam Deleted', 200);
    }

}
