@extends('users.layout')
@section('content')
<div>
    <h2>All Users</h2>

        @if ($users->isEmpty())
            <p>No users found.</p>
        @else
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Contact</th>
                        <th>Image</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->image }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
</div>
@endsection

