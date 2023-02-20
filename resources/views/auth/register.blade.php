@extends('layouts.public')

@section('content')
    @if ($errors->any())
        <div>
            <div>{{ __('Whoops! Something went wrong.') }}</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                {{-- <label>{{ __('Name') }}</label> --}}
                <div class="col mb-3 mb-sm-0">
                    <input class="form-control form-control-user" type="text" placeholder="Name" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name" />
                </div>
            </div>

            <div class="form-group">
                {{-- <label>{{ __('Email') }}</label> --}}
                <input class="form-control form-control-user" type="email" placeholder="Email Address" name="email"
                    value="{{ old('email') }}" required />
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    {{-- <label>{{ __('Password') }}</label> --}}
                    <input class="form-control form-control-user" type="password" placeholder="Password" name="password"
                        required autocomplete="new-password" />
                </div>

                <div class="col-sm-6">
                    {{-- <label>{{ __('Confirm Password') }}</label> --}}
                    <input class="form-control form-control-user" type="password" placeholder="Confirm Password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>

            <div>
                <button class="btn btn-primary btn-user btn-block" type="submit">
                    {{ __('Register') }}
                </button>
            </div>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </form>
    </div>
@endsection
