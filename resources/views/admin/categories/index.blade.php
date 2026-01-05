@extends('layout.main')

@section('title', 'Categories - KEL & CO Admin')

@section('content')
<div class="container py-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #8B7355;">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                Manage Categories
            </h1>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416;">
            <i class="fa-solid fa-plus me-2"></i>New Category
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
        <div class="card-body p-4">
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}" style="border-color: #D4C4B0;">
                    <button class="btn btn-dark" style="background:#2C2416; border-color:#2C2416;">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </form>

            @if($categories->count())
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#F5F1E8; border-color:#D4C4B0;">
                            <tr>
                                <th style="color:#2C2416; letter-spacing:0.05em;" class="fw-normal">Name</th>
                                <th style="color:#2C2416; letter-spacing:0.05em;" class="fw-normal">Slug</th>
                                <th style="color:#2C2416; letter-spacing:0.05em;" class="fw-normal">Products</th>
                                <th style="color:#2C2416; letter-spacing:0.05em;" class="fw-normal text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="py-3" style="color:#2C2416;">
                                        <strong>{{ $category->name }}</strong>
                                    </td>
                                    <td class="py-3 text-muted">{{ $category->slug }}</td>
                                    <td class="py-3">
                                        <span class="badge bg-light text-dark">{{ $category->products()->count() }}</span>
                                    </td>
                                    <td class="py-3 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary" style="border-color: #D4C4B0; color: #5C4D3C;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($categories->hasPages())
                    <div class="mt-4">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-folder-open display-4 mb-3" style="color: #C9B8A3;"></i>
                    <p class="text-muted mb-0">No categories found</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
