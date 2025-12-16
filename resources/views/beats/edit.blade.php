@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Edit beat</h5>

                <form method="POST" action="{{ route('beats.update', $beat) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $beat->title) }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3"
                        >{{ old('description', $beat->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="is_sold"
                            name="is_sold"
                            value="1"
                            {{ old('is_sold', $beat->is_sold) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="is_sold">
                            Mark as sold
                        </label>
                    </div>

                    <button class="btn btn-primary w-100">
                        Save changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
