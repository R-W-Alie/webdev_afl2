@extends('layout.main')

@section('title', 'Reviews - Admin - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">Reviews</h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">Moderate customer product reviews</div>
        </div>
    </div>

    <!-- filter search -->
    <div class="card shadow-sm mb-3" style="border:1px solid #D4C4B0;">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reviews.index') }}" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Product, customer, or comment..." style="border-color:#D4C4B0;">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small">Status</label>
                    <select name="status" class="form-select" style="border-color:#D4C4B0;">
                        <option value="pending" @selected($status === 'pending')>Pending</option>
                        <option value="approved" @selected($status === 'approved')>Approved</option>
                        <option value="rejected" @selected($status === 'rejected')>Rejected</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-dark mt-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">Filter</button>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary mt-4" style="border-color:#D4C4B0; color:#5C4D3C;">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- review -->
    <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
        <div class="card-body p-0">
            @forelse($reviews as $review)
                <div class="p-4" style="border-bottom:1px solid #E8DCC8;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="fw-normal mb-1" style="color:#2C2416;">
                                {{ $review->user->name }} - {{ $review->product->name }}
                            </h6>
                            <div class="small text-muted">
                                <span class="me-3">
                                    <i class="fa-solid fa-star" style="color:#FFC107;"></i>
                                    {{ $review->rating }}/5
                                </span>
                                <span>{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <span class="badge" style="background: {{ $review->is_approved ? '#28a745' : '#ffc107' }}; color:white;">
                            {{ $review->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                    </div>

                    <p class="text-muted small mb-3">{{ $review->comment }}</p>

                    <div class="d-flex gap-2">
                        @if(!$review->is_approved && !$review->rejected_at)
                            <form method="POST" action="{{ route('admin.reviews.approve', $review->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-check me-1"></i>Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.reviews.reject', $review->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-ban me-1"></i>Reject
                                </button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" class="d-inline"
                            onsubmit="return confirm('Delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center p-5">
                    <i class="fa-solid fa-inbox display-4 mb-3" style="color: #C9B8A3;"></i>
                    <p class="text-muted mb-0">No reviews found</p>
                </div>
            @endforelse
        </div>
    </div>

    @if($reviews->hasPages())
        <div class="mt-4">
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
