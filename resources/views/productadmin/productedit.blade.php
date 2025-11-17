@extends('layout.main')

@section('title', 'Edit Product - Kel & Co')

@section('content')
    <div class="container my-5 py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-light text-uppercase mb-4 text-dark" style="letter-spacing: 0.15em;">
                Edit Product
            </h1>
            <hr class="mx-auto opacity-75" style="width: 80px; height: 1px; background-color: #8B7355;">
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Edit Form -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold" style="color: #5C4D3C;">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $product->name) }}"
                                    placeholder="Enter product name"
                                    style="border-color: #d4c4b0;"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-semibold" style="color: #5C4D3C;">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    id="description" 
                                    name="description" 
                                    rows="4"
                                    placeholder="Enter product description"
                                    style="border-color: #d4c4b0;"
                                    required>{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="form-label fw-semibold" style="color: #5C4D3C;">
                                    Price (Rp) <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    id="price" 
                                    name="price" 
                                    value="{{ old('price', $product->price) }}"
                                    placeholder="0"
                                    min="0"
                                    step="0.01"
                                    style="border-color: #d4c4b0;"
                                    required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Image -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style="color: #5C4D3C;">
                                    Current Image
                                </label>
                                <div class="mb-3">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                        class="img-fluid rounded" style="max-height: 200px;">
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-semibold" style="color: #5C4D3C;">
                                    New Product Image <span class="small" style="color: #8B7355;">(optional)</span>
                                </label>
                                <input type="file" 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    id="image" 
                                    name="image"
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    style="border-color: #d4c4b0;"
                                    onchange="previewImage(event)">
                                <small class="form-text" style="color: #8B7355;">
                                    Leave empty to keep current image. Accepted formats: JPG, PNG, GIF. Max size: 2MB
                                </small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <p class="small fw-semibold mb-2" style="color: #5C4D3C;">New Image Preview:</p>
                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4"
                                    style="border-color: #D4C4B0; color: #5C4D3C;">
                                    Cancel
                                </a>
                                <button type="submit" class="btn text-white px-4"
                                    style="background-color: #2C2416; border-color: #2C2416;">
                                    <i class="fa-solid fa-save me-2"></i>Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection