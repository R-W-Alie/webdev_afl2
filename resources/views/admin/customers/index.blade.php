@extends('layout.admin')

@section('title', 'Customers')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 text-uppercase fw-light mb-1" style="letter-spacing:0.15em; color:#2C2416;">Customers</h1>
            <p class="text-muted mb-0">Customer accounts and basic info</p>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.customers.index') }}" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Name, email, or phone">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-dark mt-4" style="background:#2C2416; border-color:#2C2416;">Filter</button>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary mt-4">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color:#f8f7f6;">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Phone</th>
                            <th class="py-3 px-4">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td class="py-3 px-4">{{ $customer->id }}</td>
                                <td class="py-3 px-4">{{ $customer->name }}</td>
                                <td class="py-3 px-4">{{ $customer->email }}</td>
                                <td class="py-3 px-4">{{ $customer->phone ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $customer->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No customers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($customers->hasPages())
        <div class="mt-3">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
