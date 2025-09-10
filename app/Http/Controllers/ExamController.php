<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $request->validated();
        Exam::create([
            'title' => $request['title'],
            'tagline' => $request['tagline'],
            'exam_date' => $request['exam_date'],
            'exam_start_time' => $request['exam_start_time'],
            'exam_end_time' => $request['exam_end_time'],
            'instruction' => $request['instruction'],
            'full_mark' => $request['full_mark'],
            'duration' => $request['duration'],
            'can_view_result' => $request['can_view_result'],
            'is_question_random' => $request['is_question_random'],
            'is_option_random' => $request['is_option_random'],
            'is_signin_required' => $request['is_signin_required'],
            'is_specific_student' => $request['is_specific_student']
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $exam_id = $exam->id;
        $questions = Question::where('exam_id', $exam_id)->with('options')->get();
        return view('exams.show', compact('questions', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        return view('exams.create', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $validated = $request->validated();
        $exam->title = $validated['title'];
        $exam->tagline = $validated['tagline'];
        $exam->exam_date = $validated['exam_date'];
        $exam->exam_start_time = $validated['exam_start_time'];
        $exam->exam_end_time = $validated['exam_end_time'];
        $exam->instruction = $validated['instruction'];
        $exam->full_mark = $validated['full_mark'];
        $exam->duration = $validated['duration'];
        $exam->can_view_result = $validated['can_view_result'];
        $exam->is_question_random = $validated['is_question_random'];
        $exam->is_option_random = $validated['is_option_random'];
        $exam->is_signin_required = $validated['is_signin_required'];
        $exam->is_specific_student = $validated['is_specific_student'];
        $exam->save();

        return redirect()->route('exams.index', $exam)->with('success', 'Exam updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        Exam::delete();
        return redirect('exams.index')->with('success', 'Exam Deleted Successfuly');
    }

    public function submit(Request $request, $id)
    {

    }
}
