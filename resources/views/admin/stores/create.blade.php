@extends('layout.admin')

@section('title', 'Create Store')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.stores.index') }}" style="color: #8B7355;">Stores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <h1 class="display-6 fw-light text-uppercase mb-2 text-dark" style="letter-spacing: 0.15em;">
                Create New Store
            </h1>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.stores.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Store Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}" 
                                    class="form-control py-2 @error('name') is-invalid @enderror" 
                                    placeholder="Enter store name"
                                    style="border-color: #D4C4B0;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Location <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="location" value="{{ old('location') }}" 
                                    class="form-control py-2 @error('location') is-invalid @enderror" 
                                    placeholder="e.g., Surabaya, East Java"
                                    style="border-color: #D4C4B0;">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" rows="5" 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    placeholder="Enter store description"
                                    style="border-color: #D4C4B0;">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Store Image
                                </label>
                                <input type="file" name="image" accept="image/*" 
                                    class="form-control @error('image') is-invalid @enderror"
                                    style="border-color: #D4C4B0;">
                                <div class="form-text">Recommended: 800x600px, max 2MB (JPG, PNG, GIF)</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="fa-solid fa-check me-2"></i>Create Store
                                </button>
                                <a href="{{ route('admin.stores.index') }}" class="btn btn-outline-custom px-4">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-normal mb-3" style="color: #5C4D3C; letter-spacing: 0.05em;">
                            <i class="fa-solid fa-lightbulb me-2" style="color: #8B7355;"></i>Tips
                        </h6>
                        <ul class="small text-muted ps-3">
                            <li class="mb-2">Use clear, recognizable store names</li>
                            <li class="mb-2">Include complete address in location</li>
                            <li class="mb-2">Describe store features and ambiance</li>
                            <li class="mb-2">Use attractive storefront photos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection