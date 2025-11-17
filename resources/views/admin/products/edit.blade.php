@extends('layout.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" style="color: #8B7355;">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <h1 class="display-6 fw-light text-uppercase mb-2 text-dark" style="letter-spacing: 0.15em;">
                Edit Product
            </h1>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- nama product -->
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                    class="form-control py-2 @error('name') is-invalid @enderror" 
                                    placeholder="Enter product name"
                                    style="border-color: #D4C4B0;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- desc -->
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" rows="5" 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    placeholder="Enter product description"
                                    style="border-color: #D4C4B0;">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- price -->
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Price (Rp) <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" 
                                    class="form-control py-2 @error('price') is-invalid @enderror" 
                                    placeholder="0"
                                    style="border-color: #D4C4B0;">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- img -->
                            @if($product->image)
                                <div class="mb-4">
                                    <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                        Current Image
                                    </label>
                                    <div>
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                            alt="{{ $product->name }}" 
                                            class="rounded shadow-sm"
                                            style="max-width: 200px; height: auto;">
                                    </div>
                                </div>
                            @endif

                            <!-- new img upload -->
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Update Image (optional)
                                </label>
                                <input type="file" name="image" accept="image/*" 
                                    class="form-control @error('image') is-invalid @enderror"
                                    style="border-color: #D4C4B0;">
                                <div class="form-text">Leave empty to keep current image. Max 2MB (JPG, PNG, GIF)</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary-custom px-4">
                                    <i class="fa-solid fa-check me-2"></i>Update Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-custom px-4">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- product info -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-normal mb-3" style="color: #5C4D3C; letter-spacing: 0.05em;">
                            <i class="fa-solid fa-info-circle me-2" style="color: #8B7355;"></i>Product Info
                        </h6>
                        <div class="small text-muted">
                            <p class="mb-2"><strong>Created:</strong> {{ $product->created_at->format('M d, Y') }}</p>
                            <p class="mb-0"><strong>Last Updated:</strong> {{ $product->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection