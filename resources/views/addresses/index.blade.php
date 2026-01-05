@extends('layout.main')

@section('title', 'My Addresses')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">My Addresses</h1>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="list-group shadow-sm">
                @forelse($addresses as $address)
                    <div class="list-group-item d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <div class="fw-semibold">{{ $address->address_line1 }}</div>
                            @if($address->address_line2)
                                <div class="text-muted small">{{ $address->address_line2 }}</div>
                            @endif
                            <div class="text-muted small">{{ $address->city }} {{ $address->postal_code }}</div>
                            @if($address->is_default)
                                <span class="badge bg-dark mt-2">Default</span>
                            @endif
                        </div>
                        <div class="d-flex gap-2">
                            @unless($address->is_default)
                                <form action="{{ route('addresses.makeDefault', $address) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-dark btn-sm" type="submit">Make default</button>
                                </form>
                            @endunless
                            <form action="{{ route('addresses.destroy', $address) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item">No addresses yet.</div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Add address</h5>
                    <form action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Address line 1</label>
                            <input type="text" class="form-control" name="address_line1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address line 2</label>
                            <input type="text" class="form-control" name="address_line2">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal code</label>
                                <input type="text" class="form-control" name="postal_code" required>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="is_default" name="is_default">
                            <label class="form-check-label" for="is_default">
                                Set as default
                            </label>
                        </div>
                        <button class="btn btn-dark" type="submit">Save address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
