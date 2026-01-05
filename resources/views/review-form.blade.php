@extends('layout.main')

@section('title', 'Leave a Review - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" style="color: #8B7355;">Products</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.show', $product->slug) }}" style="color: #8B7355;">{{ $product->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review</li>
                    </ol>
                </nav>
                <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                    Leave a Review
                </h1>
                <div class="text-muted small" style="letter-spacing:0.05em;">Share your feedback about {{ $product->name }}</div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('review.store', $product) }}">
                        @csrf

                        <!-- Rating -->
                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Rating <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-2 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" id="rating_{{ $i }}" 
                                            value="{{ $i }}" @checked(old('rating') == $i) required>
                                        <label class="form-check-label" for="rating_{{ $i }}" style="cursor:pointer; font-size:1.5rem;">
                                            <i class="fa-solid fa-star" style="color:#FFC107;"></i>
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Comment -->
                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Your Review <span class="text-danger">*</span>
                            </label>
                            <textarea name="comment" rows="5" class="form-control @error('comment') is-invalid @enderror"
                                placeholder="Share your experience with this product..." 
                                style="border-color: #D4C4B0;">{{ old('comment') }}</textarea>
                            <div class="form-text">Minimum 10 characters</div>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Info Box -->
                        <div class="p-3 rounded mb-4" style="background:#F5F1E8; border:1px solid #D4C4B0;">
                            <div class="small text-muted">
                                <i class="fa-solid fa-info-circle me-2" style="color:#8B7355;"></i>
                                Your review will be moderated before appearing on the product page.
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                                <i class="fa-solid fa-check me-2"></i>Submit Review
                            </button>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-secondary px-4" style="border-color:#D4C4B0; color:#5C4D3C;">
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
