@extends('layout.main')

@section('title', 'Create Product - KEL & CO')

@section('content')
    <div class="container py-5">

        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}"
                            style="color: #8B7355;">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                Create New Product
            </h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">Add a new item to your catalog</div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                            @csrf

               
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control py-2 @error('name') is-invalid @enderror"
                                    placeholder="Enter product name" style="border-color: #D4C4B0;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

        
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter product description" style="border-color: #D4C4B0;">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Price (Rp) <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                    class="form-control py-2 @error('price') is-invalid @enderror" placeholder="0"
                                    style="border-color: #D4C4B0;">
                                @error('price')
                                                                <!-- Category -->
                                                                <div class="mb-4">
                                                                    <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                                                        Category <span class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" style="border-color: #D4C4B0;">
                                                                        <option value="">Select a category</option>
                                                                        @foreach(\App\Models\Category::all() as $cat)
                                                                            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Stock Quantity -->
                                                                <div class="mb-4">
                                                                    <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                                                        Stock Quantity <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}"
                                                                        class="form-control py-2 @error('stock_quantity') is-invalid @enderror" placeholder="0"
                                                                        style="border-color: #D4C4B0;">
                                                                    @error('stock_quantity')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Featured -->
                                                                <div class="mb-4 form-check">
                                                                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" 
                                                                        id="isFeatured" @checked(old('is_featured'))
                                                                        style="border-color: #D4C4B0;">
                                                                    <label class="form-check-label" for="isFeatured" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                                                        Mark as Featured
                                                                    </label>
                                                                </div>

                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                  
                            <div class="mb-4">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                    Product Image
                                </label>
                                <input type="file" name="image" accept="image/*" id="imageInput"
                                    class="form-control @error('image') is-invalid @enderror"
                                    style="border-color: #D4C4B0;">
                                <div class="form-text">
                                    Recommended: 800x800px, <strong>max 2MB</strong> (JPG, PNG, GIF)
                                </div>
                                <div id="fileSizeWarning" class="alert alert-warning mt-2 d-none">
                                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                    File size exceeds 2MB. Please choose a smaller image.
                                </div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-dark px-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                                    <i class="fa-solid fa-check me-2"></i>Create Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4" style="border-color:#D4C4B0; color:#5C4D3C;">
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
                            <li class="mb-2">Use clear, descriptive product names</li>
                            <li class="mb-2">Write detailed descriptions highlighting key features</li>
                            <li class="mb-2">Use high-quality images with good lighting</li>
                            <li class="mb-2">Ensure pricing is accurate and competitive</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
