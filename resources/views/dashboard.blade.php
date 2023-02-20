@extends('layouts.menu')

@section('content_one')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <div>You are logged in!</div>
@endsection

@section('content_two')
    <form class="d-flex" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger" type="submit">
            {{ __('Logout') }}
        </button>
    </form>
@endsection

@section('content_three')
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
        @include('profile.update-profile-information-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        @include('profile.update-password-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('profile.two-factor-authentication-form')
    @endif
@endsection


@section('card')
<div class="card h-100">
    <!-- Product image-->
    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
    <!-- Product details-->
    <div class="card-body p-4">
        <div class="text-center">
            <!-- Product name-->
            <h5 class="fw-bolder">Fancy Product</h5>
            <!-- Product price-->
            $40.00 - $80.00
        </div>
    </div>
    <!-- Product actions-->
    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
    </div>
</div>
@endsection
