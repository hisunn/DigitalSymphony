@extends('layouts.public')

@section('content')
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif

    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                {{-- <label>{{ __('Email') }}</label> --}}
                <input  aria-describedby="emailHelp" placeholder="Enter Email Address..." class="form-control form-control-user" type="email" name="email" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="form-group">
                {{-- <label>{{ __('Password') }}</label> --}}
                <input placeholder="Password" class="form-control form-control-user" type="password" name="password" required autocomplete="current-password" />
            </div>
            @if ($errors->any())
                <div>
                    <div style="text-align: center">{{ __('Whoops! Something went wrong.') }}</div>
                    <br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label>{{ __('Remember me') }}</label>
                <input type="checkbox" name="remember">
            </div>

            
            <div>
                <button class="btn btn-primary btn-user btn-block" type="submit">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <hr>
                <a href="/register" class="btn btn-google btn-user btn-block">
                    Register Now !
                </a>
            </div>
        </form>
    </div>
@endsection
