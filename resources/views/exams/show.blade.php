{{-- resources/views/exam/show.blade.php --}}
@extends('layouts.layout')

@section('content')
    <h1>Exam Questions</h1>

    <form action="{{ route('exam.submit') }}" method="POST">
        @csrf
        @foreach($questions as $question)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>{{ $question->title }}</h4>
                </div>
                <div class="card-body">
                    @foreach($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="option{{ $option->id }}" value="{{ $option->id }}">
                            <label class="form-check-label" for="option{{ $option->id }}">
                                {{ $option->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>
@endsection
