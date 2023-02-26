@extends('layouts.setting')

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
{{-- for future implementation function --}}
    {{-- @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('profile.two-factor-authentication-form')
    @endif --}}
@endsection