@extends('exams.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- Dynamically change the card header based on whether a exam object exists --}}
                    <div class="card-header">{{ isset($exam) ? 'Edit Exam' : 'Create New Exam' }}</div>

                    <div class="card-body">
                        {{-- Form action and method are dynamic based on the exam object --}}
                        <form method="POST" action="{{ isset($exam) ? route('exams.update', $exam) : route('exams.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Add the @method directive for updating --}}
                            @if (isset($exam))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ 'Title' }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $exam->title ?? '') }}" required
                                    autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tagline" class="form-label">{{ 'Tagline' }}</label>
                                <input type="text" class="form-control @error('tagline') is-invalid @enderror"
                                    id="tagline" name="tagline" value="{{ old('tagline', $exam->tagline ?? '') }}"
                                    required>
                                @error('tagline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exam_date" class="form-label">{{ 'exam_date' }}</label>
                                <input type="date" class="form-control @error('exam_date') is-invalid @enderror"
                                    id="exam_date" name="exam_date" value="{{ old('exam_date', $exam->exam_date ?? '') }}"
                                    required>
                                @error('exam_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exam_start_time" class="form-label">{{ 'exam_start_time' }}</label>
                                <input type="time" class="form-control @error('exam_start_time') is-invalid @enderror"
                                    id="exam_start_time" name="exam_start_time"
                                    value="{{ old('exam_start_time', $exam->exam_start_time ?? '') }}" required>
                                @error('exam_start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exam_end_time" class="form-label">{{ 'exam_end_time' }}</label>
                                <input type="time" class="form-control @error('exam_end_time') is-invalid @enderror"
                                    id="exam_end_time" name="exam_end_time"
                                    value="{{ old('exam_end_time', $exam->exam_end_time ?? '') }}" required>
                                @error('exam_end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="instruction" class="form-label">{{ 'Instruction' }}</label>
                                <input type="text" class="form-control @error('instruction') is-invalid @enderror"
                                    id="instruction" name="instruction"
                                    value="{{ old('instruction', $exam->instruction ?? '') }}">
                                @error('instruction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="full_mark" class="form-label">{{ 'full_mark' }}</label>
                                <input type="number" class="form-control @error('full_mark') is-invalid @enderror"
                                    id="full_mark" name="full_mark" value="{{ old('full_mark', $exam->full_mark ?? '') }}">
                                @error('full_mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">{{ 'Duration(second)' }}</label>
                                <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                    id="duration" name="duration" value="{{ old('duration', $exam->duration ?? '') }}">
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="can_view_result" class="form-label">{{ ('Can View Result') }}</label>
                                <select class="form-select @error('can_view_result') is-invalid @enderror"
                                    id="can_view_result" name="can_view_result">
                                    <option value="1"
                                        {{ old('can_view_result', $exam->can_view_result ?? '') == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('can_view_result', $exam->can_view_result ?? '') == 0 ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('can_view_result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_question_random" class="form-label">{{ ('Random Question') }}</label>
                                <select class="form-select @error('is_question_random') is-invalid @enderror"
                                    id="is_question_random" name="is_question_random">
                                    <option value="1"
                                        {{ old('is_question_random', $exam->is_question_random ?? '') == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('is_question_random', $exam->is_question_random ?? '') == 0 ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('is_question_random')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_option_random" class="form-label">{{ ('Random option') }}</label>
                                <select class="form-select @error('is_option_random') is-invalid @enderror"
                                    id="is_option_random" name="is_option_random">
                                    <option value="1"
                                        {{ old('is_option_random', $exam->is_option_random ?? '') == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('is_option_random', $exam->is_option_random ?? '') == 0 ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('is_option_random')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_signin_required" class="form-label">{{ ('Signin required') }}</label>
                                <select class="form-select @error('is_signin_required') is-invalid @enderror"
                                    id="is_signin_required" name="is_signin_required">
                                    <option value="1"
                                        {{ old('is_signin_required', $exam->is_signin_required ?? '') == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('is_signin_required', $exam->is_signin_required ?? '') == 0 ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('is_signin_required')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_specific_student" class="form-label">{{ 'Username of Specific Student' }}</label>
                                <input type="text" class="form-control @error('is_specific_student') is-invalid @enderror"
                                    id="is_specific_student" name="is_specific_student"
                                    value="{{ old('is_specific_student', $exam->is_specific_student ?? '') }}">
                                @error('is_specific_student')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Leave blank if not for specific student.</small>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($exam) ? 'Update exam' : 'Create exam' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
