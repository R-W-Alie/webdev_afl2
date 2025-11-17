@extends('layout.admin')

@section('title', 'Manage Products')

@section('content')
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-6 fw-light text-uppercase mb-2 text-dark" style="letter-spacing: 0.15em;">
                    Manage Products
                </h1>
                <p class="text-muted mb-0">Create, edit, and manage your product catalog</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary-custom px-4 py-2">
                <i class="fa-solid fa-plus me-2"></i>Add Product
            </a>
        </div>


        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #8B7355;">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <div class="row mb-4">
            <div class="col-lg-6">
                <form action="{{ route('admin.products.index') }}" method="GET">
                    <div class="input-group shadow-sm rounded">
                        <input type="text" class="form-control py-2 border-end-0 bg-white" name="search"
                            placeholder="Search products..." value="{{ request('search') }}"
                            style="border-color: #d4c4b0;">
                        <button class="btn text-white" type="submit" style="background-color: #2C2416; border-color: #2C2416;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results Info -->
        @if (request('search'))
            <div class="row mb-3">
                <div class="col-12">
                    <div class="bg-white border rounded p-3 shadow-sm" style="border-color: #D4C4B0 !important;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small">
                                Showing results for <strong>"{{ request('search') }}"</strong>
                                <span class="ms-2" style="color: #8B7355;">
                                    ({{ $products->total() }} {{ Str::plural('product', $products->total()) }} found)
                                </span>
                            </span>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-custom">
                                Clear
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f8f7f6;">
                            <tr>
                                <th class="py-3 px-4" style="color: #5C4D3C; letter-spacing: 0.05em;">Image</th>
                                <th class="py-3 px-4" style="color: #5C4D3C; letter-spacing: 0.05em;">Product Name</th>
                                <th class="py-3 px-4" style="color: #5C4D3C; letter-spacing: 0.05em;">Description</th>
                                <th class="py-3 px-4" style="color: #5C4D3C; letter-spacing: 0.05em;">Price</th>
                                <th class="py-3 px-4 text-end" style="color: #5C4D3C; letter-spacing: 0.05em;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="py-3 px-4">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                alt="{{ $product->name }}" 
                                                class="rounded shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="rounded d-flex align-items-center justify-content-center" 
                                                style="width: 60px; height: 60px; background-color: #f0f0f0;">
                                                <i class="fa-solid fa-image" style="color: #C9B8A3;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="fw-normal" style="color: #2C2416; letter-spacing: 0.03em;">
                                            {{ $product->name }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="small text-muted">
                                            {{ Str::limit($product->description, 60) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="fw-normal" style="color: #8B7355;">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', $product) }}" 
                                                class="btn btn-sm btn-outline-secondary"
                                                style="border-color: #D4C4B0; color: #5C4D3C;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fa-solid fa-box-open display-4 mb-3" style="color: #C9B8A3;"></i>
                                        <p class="text-muted mb-0">No products found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @if ($products->hasPages())
            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection