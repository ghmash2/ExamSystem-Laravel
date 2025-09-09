@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- Dynamically change the card header based on whether a user object exists --}}
                    <div class="card-header">{{ isset($user) ? 'Edit User' : 'Create New User' }}</div>

                    <div class="card-body">
                        {{-- Form action and method are dynamic based on the user object --}}
                        <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Add the @method directive for updating --}}
                            @if(isset($user))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ ('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ ('Email Address') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">{{ ('Username') }}</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contact" class="form-label">{{ ('Contact Number') }}</label>
                                <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                    id="contact" name="contact" value="{{ old('contact', $user->contact ?? '') }}">
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ ('Password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" {{ isset($user) ? '' : 'required' }}>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if(isset($user))
                                    <small class="form-text text-muted">Leave blank to keep the current password.</small>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ ('Confirm Password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ ('Profile Image') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if(isset($user) && $user->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" style="max-width: 100px;">
                                        <small class="d-block text-muted">Current image. Upload a new one to replace it.</small>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($user) ? ('Update User') : ('Create User') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
