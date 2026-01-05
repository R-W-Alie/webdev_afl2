@extends('layout.main')

@section('title', 'Profile - Kel & Co')

@section('styles')
<style>
    .profile-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        padding: 80px 0;
    }

    .profile-card {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
        max-width: 500px;
        margin: 0 auto;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, #C9B8A3 0%, #8B7355 100%);
        color: white;
        font-size: 2.5rem;
        font-weight: 300;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(139, 115, 85, 0.2);
        margin-bottom: 1.5rem;
    }

    .profile-name {
        font-size: 2rem;
        font-weight: 300;
        letter-spacing: 0.05em;
        color: #2C2416;
        margin-bottom: 0.5rem;
    }

    .profile-email {
        font-size: 1rem;
        color: #5C4D3C;
        letter-spacing: 0.03em;
        margin-bottom: 0;
    }

    .profile-divider {
        width: 60px;
        height: 1px;
        background-color: #8B7355;
        margin: 1.5rem auto;
    }

    .profile-info-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        color: #5C4D3C;
        letter-spacing: 0.02em;
        margin-bottom: 0.75rem;
    }

    .profile-info-item i {
        color: #8B7355;
        font-size: 1rem;
    }

    .profile-meta {
        font-size: 0.85rem;
        color: #8B7355;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .edit-profile-btn {
        background-color: #2C2416;
        border: 1px solid #2C2416;
        color: white;
        padding: 12px 35px;
        font-size: 0.85rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        transition: all 0.3s ease;
        font-weight: 300;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
    }

    .edit-profile-btn:hover {
        background-color: #8B7355;
        border-color: #8B7355;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="profile-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="profile-card p-5">
                    <div class="text-center">
                        <!-- pfp -->
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <!-- name -->
                        <h3 class="profile-name">{{ $user->name }}</h3>
                        
                        <!-- email -->
                        <p class="profile-email">{{ $user->email }}</p>

                        <!-- divider -->
                        <div class="profile-divider"></div>

                        <!-- since when -->
                        <p class="profile-meta mb-4">
                            Member since {{ $user->created_at->format('F Y') }}
                        </p>

                        <!-- actions -->
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary edit-profile-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection