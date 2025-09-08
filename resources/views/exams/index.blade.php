@extends('exams.layout')
@section('content')
    <div>
        <h2>All Exams</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Tagline</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Instruction</th>
                    <th>Mark</th>
                    <th>Time</th>
                    <th>Result view</th>
                    <th>Random Question</th>
                    <th>Random Option</th>
                    <th>Signin Require</th>
                    <th>Specific Student</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->title }}</td>
                        <td>{{ $exam->tagline }}</td>
                        <td>{{ $exam->exam_date }}</td>
                        <td>{{ $exam->exam_start_time }}</td>
                        <td>{{ $exam->exam_end_time }}</td>
                        <td>{{ $exam->instruction }}</td>
                        <td>{{ $exam->full_mark }}</td>
                        <td>{{ $exam->duration }}</td>
                        <td>{{ $exam->can_view_result }}</td>
                        <td>{{ $exam->is_question_random }}</td>
                        <td>{{ $exam->is_option_random }}</td>
                        <td>{{ $exam->is_signin_required }}</td>
                        <td>{{ $exam->is_specific_student }}</td>
                        <td><a href="{{ route('exams.edit', $exam) }}" class="btn btn-sm btn-primary">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
