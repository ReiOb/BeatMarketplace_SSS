@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit User</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" 
                           class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_admin" value="1" class="form-check-input" 
                           id="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_admin">
                        Admin user
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection
