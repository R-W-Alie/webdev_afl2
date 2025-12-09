@extends('layout.main')

@section('title', 'Our Stores - Kel & Co')

@section('content')
<div class="container my-5 py-5">

    <div class="text-center mb-5">
        <h1 class="display-4 fw-light text-uppercase mb-4 text-dark" style="letter-spacing: 0.15em;">
            Our Stores
        </h1>
        <hr class="mx-auto opacity-75" style="width: 80px; height: 1px; background-color: #8B7355;">
    </div>


    <div class="row g-4">
        @forelse ($stores as $store)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="overflow-hidden">
                    @if($store->image)
                        <img src="{{ asset('storage/'.$store->image) }}" class="card-img-top" alt="{{ $store->name }}" style="height: 280px; object-fit: cover;">
                    @else
                        <div class="bg-light" style="height: 280px;"></div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-normal mb-2 text-dark" style="letter-spacing: 0.05em;">{{ $store->name }}</h5>
                    <p class="small mb-3 text-secondary">{{ $store->description }}</p>
                    <div class="mt-auto">
                        <p class="small text-muted mb-1">
                            <i class="fa-solid fa-location-dot me-2"></i>{{ $store->city }}
                        </p>
                        <p class="small text-muted mb-0">{{ $store->address }}</p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fa-solid fa-store display-1 mb-3" style="color: #C9B8A3;"></i>
            <h5 class="fw-light mb-2" style="color: #5C4D3C;">No stores available</h5>
        </div>
        @endforelse
    </div>


    @if ($stores->hasPages())
        <div class="mt-5">
            {{ $stores->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
