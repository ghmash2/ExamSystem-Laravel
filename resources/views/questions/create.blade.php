@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- Dynamically change the card header based on whether a question object exists --}}
                    <div class="card-header">{{ isset($question) ? 'Edit Question' : 'Create Question' }}</div>

                    <div class="card-body">
                        {{-- Form action and method are dynamic based on the question object --}}
                        <form method="POST"
                            action="{{ isset($question) ? route('questions.update', $question) : route('questions.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Add the @method directive for updating --}}
                            @if (isset($question))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ 'title' }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $question->title ?? '') }}"
                                    required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="question_type" class="form-label">{{ 'Question Type' }}</label>
                                <input type="question_type"
                                    class="form-control @error('question_type') is-invalid @enderror" id="question_type"
                                    name="question_type" value="{{ old('question_type', $question->question_type ?? '') }}"
                                    required>
                                @error('question_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exam_id" class="form-label">{{ 'Select Exam' }}</label>
                                <select class="form-select @error('exam_id') is-invalid @enderror" id="exam_id"
                                    name="exam_id">
                                    @foreach ($exams as $exam)
                                        <option value={{ $exam->id }} @selected(old('exam_id', $question->exam_id ?? null) == $exam->id)>
                                            {{ $exam->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('exam_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary">
                                {{ isset($question) ? 'Update question' : 'Create question' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
