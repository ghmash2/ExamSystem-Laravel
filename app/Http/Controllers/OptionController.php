<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
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
        $exams = Exam::all();
        $questions = Question::all();
        return view('options.create', compact('exams', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionRequest $request)
    {
       $request->validated();
        Option::create([
            'title' => $request['title'],
            'is_correct' => $request['is_correct'],
            'question_id' => $request['question_id']
        ]);
     return redirect()->route('options.create')->with('success', 'Successfully added Question');
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('options.create', compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionRequest $request, Option $option)
    {
         $validated = $request->validated();
         $option->title = $validated['title'];
         $option->is_correct = $validated['is_correct'];
         $option->question_id = $validated['question_id'];
         $option->save();

         return redirect()->route('options.index')->with('success', 'Option Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }
    public function getOptionByQuestion($id)
    {
        $options = Option::where('question_id', $id)->get();
        return $options;
    }
}
