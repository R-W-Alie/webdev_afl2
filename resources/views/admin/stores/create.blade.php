@extends('layout.main')

@section('title', 'Create Store - KEL & CO')

@section('content')
    <div class="container py-5">
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.stores.index') }}" style="color: #8B7355;">Stores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                Create New Store
            </h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">Add a new boutique location</div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
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
                                    Address <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="address" value="{{ old('address') }}" 
                                    class="form-control py-2 @error('address') is-invalid @enderror" 
                                    placeholder="123 Main St"
                                    style="border-color: #D4C4B0;">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    City <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="city" value="{{ old('city') }}" 
                                    class="form-control py-2 @error('city') is-invalid @enderror" 
                                    placeholder="e.g., Surabaya"
                                    style="border-color: #D4C4B0;">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" 
                                            class="form-control py-2 @error('phone') is-invalid @enderror" 
                                            placeholder="e.g., +62 812 3456 7890"
                                            style="border-color: #D4C4B0;">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" 
                                            class="form-control py-2 @error('email') is-invalid @enderror" 
                                            placeholder="store@example.com"
                                            style="border-color: #D4C4B0;">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
                                <button type="submit" class="btn btn-dark px-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                                    <i class="fa-solid fa-check me-2"></i>Create Store
                                </button>
                                <a href="{{ route('admin.stores.index') }}" class="btn btn-outline-secondary px-4" style="border-color:#D4C4B0; color:#5C4D3C;">
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