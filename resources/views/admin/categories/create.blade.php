@extends('layout.main')

@section('title', 'Create Category - KEL & CO Admin')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #8B7355;">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}" style="color: #8B7355;">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
            Create New Category
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                class="form-control py-2 @error('name') is-invalid @enderror" 
                                placeholder="e.g., Women's Tops"
                                style="border-color: #D4C4B0;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Slug <span class="text-muted small">(auto-generated)</span>
                            </label>
                            <input type="text" name="slug" value="{{ old('slug') }}" 
                                class="form-control py-2 @error('slug') is-invalid @enderror" 
                                placeholder="womens-tops"
                                style="border-color: #D4C4B0;">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Leave blank to auto-generate from name</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Description
                            </label>
                            <textarea name="description" rows="4" 
                                class="form-control @error('description') is-invalid @enderror" 
                                placeholder="Describe this category..."
                                style="border-color: #D4C4B0;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4" style="background:#2C2416; border-color:#2C2416;">
                                <i class="fa-solid fa-check me-2"></i>Create Category
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary px-4" style="border-color:#D4C4B0; color:#5C4D3C;">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
