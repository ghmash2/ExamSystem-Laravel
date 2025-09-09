@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- Dynamically change the card header based on whether a option object exists --}}
                    <div class="card-header">{{ isset($option) ? 'Edit option' : 'Create option' }}</div>

                    <div class="card-body">
                        {{-- Form action and method are dynamic based on the option object --}}
                        <form method="POST"
                            action="{{ isset($option) ? route('options.update', $option) : route('options.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Add the @method directive for updating --}}
                            @if (isset($option))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ 'title' }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $option->title ?? '') }}" required
                                    autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="is_correct" class="form-label">{{ 'Correct?' }}</label>
                                <select class="form-select @error('is_correct') is-invalid @enderror" id="is_correct"
                                    name="is_correct">
                                    <option value="0"
                                        {{ old('is_correct', $option->is_correct ?? '') == 0 ? 'selected' : '' }}>
                                        No</option>
                                    <option value="1"
                                        {{ old('is_correct', $option->is_correct ?? '') == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                </select>
                                @error('is_correct')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exam_id" class="form-label">{{ 'Select Exam' }}</label>
                                <select class="form-select @error('exam_id') is-invalid @enderror" id="exam_id"
                                    name="exam_id">
                                    <option value="">Select an Exam</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}" @selected(old('exam_id', $option->exam_id ?? null) == $exam->id)>
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
                            <div class="mb-3">
                                <label for="question_id" class="form-label">{{ 'Select question' }}</label>
                                <select class="form-select @error('question_id') is-invalid @enderror" id="question_id"
                                    name="question_id">
                                    <option value="">Select an question</option>
                                    @foreach ($questions as $question)
                                        <option value="{{ $question->id }}" @selected(old('question_id', $option->question_id ?? null) == $question->id)>
                                            {{ $question->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('question_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary">
                                {{ isset($option) ? 'Update option' : 'Create option' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
