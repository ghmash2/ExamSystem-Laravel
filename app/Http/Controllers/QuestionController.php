<?php

namespace App\Http\Controllers;

use App\ApiResponseClass;
use App\Http\Requests\QuestionRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
class QuestionController extends BaseController
{
     public function __construct() {
        $this->middleware('permission:manage_question')->only(['index', 'store', 'show', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $exams = Exam::all();
        // return view('questions.create', compact('exams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        // $validated = $request->validated();
        // $question = Question::create($validated)
        // return ApiResponseClass::sendResponse(new );
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
       return view('questions.create', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
       $validated = $request->validated();
       $question->title = $validated['title'];
       $question->question_type = $validated['question_type'];
       $question->exam_id = $validated['exam_id'];
       $question->status = $validated['status'];
       $question->save();
       return redirect()->route('questions.index')->with('success', 'Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
    public function getQuestionByExam($id)
    {
        $questions = Question::where('exam_id', $id)->get();
        return $questions;
    }
}
